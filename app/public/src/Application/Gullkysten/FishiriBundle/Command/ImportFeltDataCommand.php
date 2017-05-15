<?php

namespace Application\Gullkysten\FishiriBundle\Command;

use Application\Gullkysten\FishiriBundle\Document\FeltData\Destination;
use Application\Gullkysten\FishiriBundle\Document\FeltData\DrillingWells;
use Application\Gullkysten\FishiriBundle\Document\FeltData\ExportTechnology;
use Application\Gullkysten\FishiriBundle\Document\FeltData\FeltData;
use Application\Gullkysten\FishiriBundle\Document\FeltData\FieldDevelopment;
use Application\Gullkysten\FishiriBundle\Document\FeltData\FrameAgreement;
use Application\Gullkysten\FishiriBundle\Document\FeltData\Helicopter;
use Application\Gullkysten\FishiriBundle\Document\FeltData\Investments;
use Application\Gullkysten\FishiriBundle\Document\FeltData\Npdid;
use Application\Gullkysten\FishiriBundle\Document\FeltData\RemainingReserves;
use Application\Gullkysten\FishiriBundle\Document\FeltData\Statistics;
use Application\Gullkysten\FishiriBundle\Document\FeltData\SubseaDevelopment;
use Application\Gullkysten\FishiriBundle\Document\FeltData\TotalReservesEstimate;
use Application\Gullkysten\FishiriBundle\Document\Operator;
use Application\Sonata\MediaBundle\Document\Gallery;
use Application\Sonata\MediaBundle\Document\GalleryItem;
use Application\Sonata\MediaBundle\Document\Media;
use DateTime;
use Exception;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ImportFeltDataCommand
 * @package Application\Gullkysten\FishiriBundle\Command
 */
class ImportFeltDataCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('fishiri:gullkysten:feltdata:import')
            ->setDescription('Import FeltData from xlsx file')
            ->addArgument(
                'file',
                InputArgument::REQUIRED,
                'Path to a file with FeltData to import'
            );
    }

    /**
     * Executes the current command.
     *
     * This method is not abstract because you can use this class
     * as a concrete class. In this case, instead of defining the
     * execute() method, you set the code to execute by passing
     * a Closure to the setCode() method.
     *
     * @param InputInterface  $input  An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     *
     * @return null|int null or 0 if everything went fine, or an error code
     *
     * @throws LogicException When this abstract method is not implemented
     *
     * @see setCode()
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($this->getContainer()->has('profiler'))
        {
            $this->getContainer()->get('profiler')->disable();
        }
        $status = $this->import($input->getArgument('file'));
        $output->writeln($status);
    }

    /**
     * @param $pathToFile
     * @return string
     */
    private function import($pathToFile) {
        $status = 'Success';
        $doctrine = $this->getContainer()->get('doctrine_mongodb');
        $dm = $doctrine->getManager();

        try {
            $feltDatas = $this->initializeCSV($pathToFile);
            foreach ($feltDatas as $feltData) {
                $feltDataObject = $doctrine
                    ->getRepository('ApplicationGullkystenFishiriBundle:FeltData\FeltData')
                    ->findOneBy(['name' => $feltData[0]]);
                if (empty($feltDataObject)) {
                    $this->importDocuments($feltData, $dm);   
                }
            }

            $dm->flush();
        } catch (\Exception $e) {
            $status = $e->getMessage();
        }
        return $status;
    }

    /**
     * @param $csv_main
     * @return array
     */
    private function initializeCSV($csv_main){
        $csvArray = [];
        $lines = file($csv_main, FILE_IGNORE_NEW_LINES);
        foreach ($lines as $key => $value)
        {
            if($key) {
                $csvArray[$key] = str_getcsv($value);
            }
        }
        unset($csvArray[0], $csvArray[1]);
        return $csvArray;
    }

    /**
     * @param $feltData
     * @param $dm
     */
    private function importDocuments($feltData, $dm) {
        $operatorName = trim($feltData[2]);
        $feltDataObject = new FeltData();
        $feltDataObject->setName($feltData[0]);
        if($operatorName) {
            $operator = $dm->getRepository('ApplicationGullkystenFishiriBundle:Operator')->findOneBy(['name' => $operatorName]);
            if (empty($operator)) {
                $operator = new Operator();
                $operator->setName($operatorName);
            }
            $operator->addFeltData($feltDataObject);
            $feltDataObject->setOperator($operator);
        }
        $dm->persist($feltDataObject);
        $feltDataObject->setStatus($feltData[1]);
        $feltDataObject->setDescription($feltData[60]);
        $feltDataObject->setDiscoveryYear($feltData[3]);
        $feltDataObject->setOnStream($feltData[4]);
        $feltDataObject->setLocation($this->renameLocation($feltData[6]));
        $feltDataObject->setProductionLicense($feltData[5]);
        $feltDataObject->setSupplyBase($feltData[50]);
        $feltDataObject->setWaterDepth($feltData[7]);
        $feltDataObject->setFrameAgreement($this->createFrameAgreement($feltData));
        $feltDataObject->setExportTechnology($this->createExportTechnology($feltData));
        $feltDataObject->setDestination($this->createDestination($feltData));
        $feltDataObject->setDrillingWells($this->createDrillingWells($feltData));
        $feltDataObject->setHelicopter($this->createHelicopter($feltData));
        $feltDataObject->setInvestments($this->createInvestments($feltData));
        $feltDataObject->setFieldDevelopment($this->createFieldDevelopment($feltData));
        $feltDataObject->setNpdid($this->createNpdid($feltData));
        $feltDataObject->setRemainingReserves($this->createRemainingReserves($feltData));
        $feltDataObject->setStatistics($this->createStatistics($feltData));
        $feltDataObject->setSubseaDevelopment($this->createSubseaDevelopment($feltData));
        $feltDataObject->setTotalReservesEstimate($this->createTotalReservesEstimates($feltData));
        $imageBase = explode(", ", $feltData[62]);
        if (!empty($imageBase)) {
            $feltDataObject->setGallery($this->createGallery($imageBase, $dm, $feltData[0]));
        }

        $dm->merge($feltDataObject);
        $dm->flush();
        $dm->clear();
    }

    /**
     * @param $fileName
     * @param $dm
     * @param $feltName
     * @return Media
     */
    private function reUploadMedia($fileName, $dm, $feltName) {
        $date = new DateTime();
        $localTempFileName = 'web/uploads/tmp_'.$feltName.'_'.$date->getTimestamp().'.jpg';
        $this->downloadMedia($fileName, $localTempFileName);
        $file = new \Symfony\Component\HttpFoundation\File\File($localTempFileName);

        $provider = $this->getContainer()->get('sonata.media.provider.image');
        $media = new Media();
        $media->setName($feltName.'_'.$date->getTimestamp());
        $media->setBinaryContent($file);
        $media->setContext('default');
        $media->setProviderName('sonata.media.provider.image');
        $media->setEnabled(true);
        $provider->transform($media);
        $provider->prePersist($media);
        $dm->persist($media);
        $provider->postPersist($media);
        $dm->flush();
        unlink($localTempFileName);
        return $media;
    }

    /**
     * @param $fileName
     * @param $localTempFileName
     */
    private function downloadMedia($fileName, $localTempFileName) {
        $client = new \GuzzleHttp\Client();
        $client->request('GET', $fileName, ['sink' => $localTempFileName]);
    }

    /**
     * @param $feltImages
     * @param $dm
     * @param $feltName
     * @return Gallery|null
     */
    private function createGallery($feltImages, $dm, $feltName) {
        try {
            $prepend = 'http://img.offshore.no/sak/';
            $galleryItems = [];
            $gallery = new Gallery();
            $gallery->setName($feltName.' gallery');
            $gallery->setEnabled(true);
            $gallery->setContext('Default');
            $gallery->setDefaultFormat('default_default');
            $gallery->setGalleryItems([]);
            foreach($feltImages as $riggImage) {
                $pathParts = pathinfo(parse_url($prepend . $riggImage, PHP_URL_PATH));
                if(!empty($pathParts['extension'])) {
                    $fileName = $prepend . $pathParts['filename'] . '.' . strtolower($pathParts['extension']);
                    $galleryItems[] = $this->createGalleryItem($dm, $fileName, $gallery, $feltName);
                }
            }
            $gallery->setGalleryItems($galleryItems);
            return $gallery;
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * @param $dm
     * @param $fileName
     * @param $gallery
     * @return GalleryItem
     */
    private function createGalleryItem($dm, $fileName, $gallery, $feltName)
    {
        $galleryItem = new GalleryItem();
        $media = $this->reUploadMedia($fileName, $dm, $feltName);
        $media->addGalleryItem($galleryItem);
        $galleryItem->setMedia($media);
        $gallery->addGalleryItem($galleryItem);
        $galleryItem->setEnabled(true);
        return $galleryItem;
    }

    /**
     * @param $itemLocation
     * @return string
     */
    private function renameLocation($itemLocation) {
        switch ($itemLocation) {
            case 'BS' :
                $itemLocation = 'Barentshavet';
                break;
            case 'NOS' :
                $itemLocation = 'Norskehavet';
                break;
            case 'NS (N)' :
                $itemLocation = 'Nordsjøen (nord)';
                break;
            case 'NS (S)' :
                $itemLocation = 'Nordsjøen (sør)';
                break;
            case 'NS (M)' :
                $itemLocation = 'Nordsjøen (midtre)';
                break;
        }
        return $itemLocation;
    }

    /**
     * @param $totalInvests
     * @param $soFar
     * @param $remaining
     * @return int|string
     */
    private function formatInvests($totalInvests, $soFar, $remaining) {
        return $remaining != "" ? str_replace(",", "", $totalInvests) -
            str_replace(",", "", $soFar) : 0;
    }

    /**
     * @param $number
     * @return int|mixed
     */
    protected function prettyNumberFormat($number) {
        return isset($number) ? str_replace(",", "", $number) : 0;
    }

    /**
     * @param $feltData
     * @return FrameAgreement
     */
    private function createFrameAgreement($feltData)
    {
        $frameAgreement = new FrameAgreement();
        $frameAgreement->setMm($feltData[11] == "" ? "N/A" : $feltData[11]);
        $frameAgreement->setMmContractExpires($feltData[12] == "" ? "N/A" : $feltData[12]);
        $frameAgreement->setIso($feltData[13] == "" ? "N/A" : $feltData[13]);
        $frameAgreement->setIsoContractExpires($feltData[14] == "" ? "N/A" : $feltData[14]);
        $frameAgreement->setDrillingAndWell($feltData[15] == "" ? "N/A" : $feltData[15]);
        $frameAgreement->setDrillingAndWellContractExpires($feltData[16] == "" ? "N/A" : $feltData[16]);
        return $frameAgreement;
    }

    /**
     * @param $feltData
     * @return ExportTechnology
     */
    private function createExportTechnology($feltData)
    {
        $exportTechnology = new ExportTechnology();
        $exportTechnology->setOil($feltData[41]);
        $exportTechnology->setGas($feltData[42]);
        $exportTechnology->setCondensate($feltData[43]);
        return $exportTechnology;
    }

    /**
     * @param $feltData
     * @return Destination
     */
    private function createDestination($feltData)
    {
        $destination = new Destination();
        $destination->setOil($feltData[44]);
        $destination->setGas($feltData[45]);
        $destination->setCondensate($feltData[46]);
        return $destination;
    }

    /**
     * @param $feltData
     * @return DrillingWells
     */
    private function createDrillingWells($feltData)
    {
        $drillingWells = new DrillingWells();
        $drillingWells->setExploration($feltData[30]);
        $drillingWells->setDevelopment($feltData[31]);
        $drillingWells->setTopReservoirDepth($feltData[32]);
        return $drillingWells;
    }

    /**
     * @param $feltData
     * @return Helicopter
     */
    private function createHelicopter($feltData)
    {
        $helicopter = new Helicopter();
        $helicopter->setFlightService($feltData[47]);
        $helicopter->setFlightBase($feltData[48]);
        $helicopter->setOffshoreBased($feltData[49]);
        return $helicopter;
    }

    /**
     * @param $feltData
     * @return FieldDevelopment
     */
    private function createFieldDevelopment($feltData)
    {
        $fieldDevelopment = new FieldDevelopment();
        $fieldDevelopment->setProductionStructure($feltData[17]);
        $fieldDevelopment->setProductionDrillingQuarters($feltData[18]);
        $fieldDevelopment->setMaterial($feltData[19]);
        $fieldDevelopment->setAdditionalInfo($feltData[20]);
        return $fieldDevelopment;
    }

    /**
     * @param $feltData
     * @return Npdid
     */
    private function createNpdid($feltData)
    {
        $npdid = new Npdid();
        $npdid->setOwner($feltData[64]);
        $npdid->setField($feltData[65]);
        $npdid->setWellbore($feltData[66]);
        $npdid->setCompany($feltData[67]);
        if($feltData[65]) {
            $npdid->setFactsLink($this->getFactsLink($feltData[65]));
            $npdid->setMapLink($this->getMapLink($feltData[65]));
        }
        return $npdid;
    }

    /**
     * @param $feltData
     * @return RemainingReserves
     */
    private function createRemainingReserves($feltData)
    {
        $remainingReserves = new RemainingReserves();
        $remainingReserves->setOil($this->prettyNumberFormat($feltData[33]));
        $remainingReserves->setOilBarrels($this->prettyNumberFormat($feltData[34]));
        $remainingReserves->setAtCurrentOilPrice($this->prettyNumberFormat($feltData[35]));
        $remainingReserves->setOil($this->prettyNumberFormat($feltData[36]));
        return $remainingReserves;
    }

    /**
     * @param $feltData
     * @return Statistics
     */
    private function createStatistics($feltData)
    {
        $statistics = new Statistics();
        $statistics->setTopWaterDepth($feltData[51]);
        $statistics->setTopInvestments($feltData[52]);
        $statistics->setTopRemainingInvestments($feltData[53]);
        $statistics->setTopOilDiscovery($feltData[54]);
        $statistics->setTopGasDiscovery($feltData[55]);
        $statistics->setTopRemainingOilReserves($feltData[56]);
        $statistics->setTopRemainingGasReserves($feltData[57]);
        $statistics->setTopRemainingCondensateReserves($feltData[58]);
        $statistics->setTopRemainingNglReserves($feltData[59]);
        return $statistics;
    }

    /**
     * @param $feltData
     * @return SubseaDevelopment
     */
    private function createSubseaDevelopment($feltData)
    {
        $subseaDevelopment = new SubseaDevelopment();
        $subseaDevelopment->setSubseaCompany($feltData[21]);
        $subseaDevelopment->setSubseaTemplate($feltData[22]);
        $subseaDevelopment->setTotalTrees($feltData[23]);
        $subseaDevelopment->setFmc($feltData[24]);
        $subseaDevelopment->setAks($feltData[25]);
        $subseaDevelopment->setGe($feltData[26]);
        $subseaDevelopment->setCam($feltData[27]);
        $subseaDevelopment->setSubseaTieback($feltData[28]);
        $subseaDevelopment->setTiebackDistance($feltData[29]);
        return $subseaDevelopment;
    }

    /**
     * @param $feltData
     * @return TotalReservesEstimate
     */
    private function createTotalReservesEstimates($feltData)
    {
        $totalReserve = new TotalReservesEstimate();
        $totalReserve->setOil($this->prettyNumberFormat($feltData[37]));
        $totalReserve->setGas($this->prettyNumberFormat($feltData[38]));
        $totalReserve->setCondensate($this->prettyNumberFormat($feltData[39]));
        $totalReserve->setNgl($this->prettyNumberFormat($feltData[40]));
        return $totalReserve;
    }

    /**
     * @param $feltData
     * @return Investments
     */
    private function createInvestments($feltData)
    {
        $investments = new Investments();
        $investments->setTotalInvestments($this->prettyNumberFormat($feltData[8]));
        $investments->setSoFarInvestments($this->prettyNumberFormat($feltData[9]));
        $investments->setRemainingInvestments($this->formatInvests($feltData[8], $feltData[9], $feltData[10]));
        return $investments;
    }

    /**
     * @param $id
     * @return string
     */
    private function getFactsLink($id) {
        return 'http://factpages.npd.no/factpages/Default.aspx?culture=nb-no&nav1=field&nav2=PageView|All&nav3=' . $id;
    }

    /**
     * @param $id
     * @return string
     */
    private function getMapLink($id) {
        return 'http://www.npd.no/FactMapSearch?NPDID_field=' . $id;
    }
}