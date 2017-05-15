<?php

namespace Application\Gullkysten\FishiriBundle\Command;

use Application\Gullkysten\FishiriBundle\Document\Operator;
use Application\Gullkysten\FishiriBundle\Document\RiggData\BopAndBopControlData;
use Application\Gullkysten\FishiriBundle\Document\RiggData\ContractInformation;
use Application\Gullkysten\FishiriBundle\Document\RiggData\DrillingEquipment;
use Application\Gullkysten\FishiriBundle\Document\RiggData\LandingFacilities;
use Application\Gullkysten\FishiriBundle\Document\RiggData\LiftingEquipment;
use Application\Gullkysten\FishiriBundle\Document\RiggData\MudSystems;
use Application\Gullkysten\FishiriBundle\Document\RiggData\RiggData;
use Application\Gullkysten\FishiriBundle\Document\Owner;
use Application\Gullkysten\FishiriBundle\Document\RiggData\RigInformation;
use Application\Gullkysten\FishiriBundle\Document\RiggData\RigRatings;
use Application\Gullkysten\FishiriBundle\Document\RiggData\RiserAndRiserTensionerData;
use Application\Gullkysten\FishiriBundle\Document\RiggData\VesselParticulars;
use Application\Gullkysten\FishiriBundle\Document\RiggData\VesselParticularsContinued;
use Application\Sonata\MediaBundle\Document\Gallery;
use Application\Sonata\MediaBundle\Document\GalleryItem;
use Application\Sonata\MediaBundle\Document\Media;
use DateTime;
use Exception;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ImportRiggDataCommand
 * @package Application\Gullkysten\FishiriBundle\Command
 */
class ImportRiggDataCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('fishiri:gullkysten:riggdata:import')
            ->setDescription('Import RiggData from xlsx file')
            ->addArgument(
                'file',
                InputArgument::REQUIRED,
                'Path to a file with RiggData to import'
            )
            ->addArgument(
                'contractsFile',
                InputArgument::REQUIRED,
                'Path to a file with RiggData contracts to import'
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
        $status = $this->import($input->getArgument('file'), $input->getArgument('contractsFile'));
        $output->writeln($status);
    }

    /**
     * @param $pathToFile
     * @param $pathToContractsFile
     * @return string
     */
    private function import($pathToFile, $pathToContractsFile) {
        $status = 'Success';
        $dm = $this->getContainer()->get('doctrine_mongodb')->getManager();

        try {
            $riggDatas = $this->initializeCSV($pathToFile);
            $contracts = $this->initializeCsvContracts($pathToContractsFile);
            foreach ($riggDatas as $riggData) {
                $this->importDocuments($riggData, $dm, $this->getContractsByRiggId($contracts, $riggData[0]));
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
    private function initializeCSV($csv_main) {
        $csvArray = [];
        $lines = file($csv_main, FILE_IGNORE_NEW_LINES);
        foreach ($lines as $key => $value)
        {
            if($key) {
                $csvArray[$key] = str_getcsv($value);
            }
        }
        unset($csvArray[0], $csvArray[1], $csvArray[2]);
        return $csvArray;
    }

    /**
     * @param $riggData
     * @param $dm
     * @param $contracts
     */
    private function importDocuments($riggData, $dm, $contracts) {
        $ownerName = trim($riggData[2]);
        $operatorName = trim($riggData[3]);
        $owner = $dm->getRepository('ApplicationGullkystenFishiriBundle:Owner')->findOneBy(['name' => $ownerName]);
        if (empty($owner)) {
            $owner = new Owner();
            $owner->setName($ownerName);
        }

        $riggDataObject = new RiggData();
        $riggDataObject->setRigId($riggData[0]);
        $riggDataObject->setName($riggData[1]);
        $owner->addRiggData($riggDataObject);
        $riggDataObject->setOwner($owner);
        if($operatorName) {
            $operator = $dm->getRepository('ApplicationGullkystenFishiriBundle:Operator')->findOneBy(['name' => $operatorName]);
            if (empty($operator)) {
                $operator = new Operator();
                $operator->setName($operatorName);
            }
            $operator->addRiggData($riggDataObject);
            $riggDataObject->setOperator($operator);
        }
        $dm->persist($riggDataObject);
        $riggDataObject->setType($riggData[75]);
        $riggDataObject->setRigInformation($this->createRiggInformation($riggData));
        $riggDataObject->setRiserAndRiserTensionerData($this->createRiserAndRiserTensionerData($riggData));
        $riggDataObject->setRigRatings($this->createRigRatings($riggData));
        $riggDataObject->setBopAndBopControlData($this->createBopAndBopControlData($riggData));
        $riggDataObject->setDrillingEquipment($this->createDrillingEquipment($riggData));
        $riggDataObject->setLandingFacilities($this->createLandingFacilities($riggData));
        $riggDataObject->setLiftingEquipment($this->createLiftingEquipment($riggData));
        $riggDataObject->setMudSystems($this->createMudSystems($riggData));
        $riggDataObject->setVesselParticulars($this->createVesselParticulars($riggData));
        $riggDataObject->setVesselParticularsContinued($this->createVesselParticularsContinued($riggData));
        $riggDataObject->setContractInformation($this->createContractInformation($contracts, $riggData[14], $riggDataObject));
        $imageBase = explode(", ", $riggData[74]);
        if (!empty($imageBase)) {
            $riggDataObject->setGallery($this->createGallery($imageBase, $dm, $riggData[1]));
        }
        $dm->merge($riggDataObject);
        $dm->flush();
        $dm->clear();
    }

    /**
     * @param $fileName
     * @param $dm
     * @param $riggName
     * @return Media
     */
    private function reUploadMedia($fileName, $dm, $riggName) {
        $date = new DateTime();
        $localTempFileName = 'web/uploads/tmp_'.$riggName.'_'.$date->getTimestamp().'.jpg';
        $this->downloadMedia($fileName, $localTempFileName);
        $file = new \Symfony\Component\HttpFoundation\File\File($localTempFileName);

        $provider = $this->getContainer()->get('sonata.media.provider.image');
        $media = new Media();
        $media->setName($riggName.'_'.$date->getTimestamp());
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
     * @param $riggImages
     * @param $dm
     * @param $riggName
     * @return Gallery|null
     */
    private function createGallery($riggImages, $dm, $riggName) {
        try {
            $prepend = 'http://img.offshore.no/sak/';
            $galleryItems = [];
            $gallery = new Gallery();
            $gallery->setName($riggName.' gallery');
            $gallery->setEnabled(true);
            $gallery->setContext('Default');
            $gallery->setDefaultFormat('default_default');
            $gallery->setGalleryItems([]);
            foreach($riggImages as $riggImage) {
                $pathParts = pathinfo(parse_url($prepend . $riggImage, PHP_URL_PATH));
                if(!empty($pathParts['extension'])) {
                    $fileName = $prepend . $pathParts['filename'] . '.' . strtolower($pathParts['extension']);
                    $galleryItems[] = $this->createGalleryItem($dm, $fileName, $gallery, $riggName);
                }
            }
            $gallery->setGalleryItems($galleryItems);
            return $gallery;
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * @param $contracts
     * @param $sector
     * @param $riggData
     * @return array
     */
    private function createContractInformation($contracts, $sector, $riggData) {
        $contractsInfo = [];
        if(!empty($contracts)) {
            foreach ($contracts as $contract) {
                $daysCount = $this->daysInMonth($contract['To_month'], $contract['To_year']);
                $fromDate = new DateTime();
                $fromDate->setDate($contract['From_year'], $contract['From_month'], $contract['From_day'] == '' ? '1' : $contract['From_day']);
                $toDate = new DateTime();
                $toDate->setDate($contract['To_year'], $contract['To_month'], $contract['To_day'] == '' ? $daysCount : $contract['To_day']);
                $contractInformation = new ContractInformation();
                $contractInformation->setStatus($contract['Status']);
                if (isset($contract['is_active']) && $contract['is_active']) {
                    $riggData->setStatus($contract['Status']);
                    $contractInformation->setSector($sector);
                }
                $contractInformation->setOperator($contract['Operator']);
                $contractInformation->setContractStarted($fromDate);
                $contractInformation->setContractExpires($toDate);
                $contractInformation->setComment($contract['Comment']);
                $contractInformation->setDayRate(str_replace(['$', ',', ' '], '', $contract['Dayrate']));
                $contractsInfo[] = $contractInformation;
            }
        }
        return $contractsInfo;
    }

    /**
     * @param $riggData
     * @return RigInformation
     */
    private function createRiggInformation($riggData) {
        $riggInfo = new RigInformation();
        $riggInfo->setVesselType($riggData[5]);
        $riggInfo->setVesselDesign($riggData[6]);
        $riggInfo->setConstructionDate($riggData[7]);
        $riggInfo->setUpgradeDate($riggData[8]);
        $riggInfo->setVesselDesign($riggData[6]);
        $riggInfo->setClassification($riggData[9]);
        return $riggInfo;
    }

    /**
     * @param $riggData
     * @return RigRatings
     */
    private function createRigRatings($riggData) {
        $rigRatings = new RigRatings();
        $rigRatings->setMaximumWaterDepth(str_replace([',', ' '], '', $riggData[10]));
        $rigRatings->setMaximumDrillingDepth(str_replace([',', ' '], '', $riggData[11]));
        return $rigRatings;
    }

    /**
     * @param $riggData
     * @return RiserAndRiserTensionerData
     */
    private function createRiserAndRiserTensionerData($riggData) {
        $riserAndRiserTensionerData = new RiserAndRiserTensionerData();
        $riserAndRiserTensionerData->setRiserTensionersTotalCapacity($riggData[56]);
        $riserAndRiserTensionerData->setRiserTensionersNumber($riggData[57]);
        $riserAndRiserTensionerData->setRiserTensionersManufacturer($riggData[58]);
        $riserAndRiserTensionerData->setDiverterSize($riggData[59]);
        $riserAndRiserTensionerData->setRiserSize($riggData[60]);
        $riserAndRiserTensionerData->setRiserJointLength($riggData[61]);
        $riserAndRiserTensionerData->setRiserManufacturer($riggData[62]);
        return $riserAndRiserTensionerData;
    }

    /**
     * @param $riggData
     * @return BopAndBopControlData
     */
    private function createBopAndBopControlData($riggData) {
        $bopData = new BopAndBopControlData();
        $bopData->setBopOperatingPressure($riggData[63]);
        $bopData->setCkLineSize($riggData[64]);
        $bopData->setRamBopsNumber($riggData[65]);
        $bopData->setRamBopsManufacturer($riggData[66]);
        $bopData->setAnnularBopsNumber($riggData[67]);
        $bopData->setAnnularBopsManufacturer($riggData[68]);
        $bopData->setWellheadConnectorType($riggData[69]);
        $bopData->setBopControlSystemType($riggData[70]);
        $bopData->setBopControlSystemManufacturer($riggData[71]);
        return $bopData;
    }

    /**
     * @param $riggData
     * @return DrillingEquipment
     */
    private function createDrillingEquipment($riggData) {
        $drillingEquipment = new DrillingEquipment();
        $drillingEquipment->setDerrickRating($riggData[36]);
        $drillingEquipment->setDerrickManufacturer($riggData[37]);
        $drillingEquipment->setDerrickFootprint($riggData[38]);
        $drillingEquipment->setDrawworksPower($riggData[39]);
        $drillingEquipment->setDrawworksManufacturer($riggData[40]);
        $drillingEquipment->setDrillLineSize($riggData[41]);
        $drillingEquipment->setRotaryTableSize($riggData[42]);
        $drillingEquipment->setIronRoughneck($riggData[43]);
        $drillingEquipment->setTopDrive($riggData[44]);
        $drillingEquipment->setHeaveCompensatorManufacturer($riggData[45]);
        $drillingEquipment->setHeaveCompensatorCapacity($riggData[46]);
        $drillingEquipment->setPipeRackingSystem($riggData[47]);
        return $drillingEquipment;
    }

    /**
     * @param $riggData
     * @return LandingFacilities
     */
    private function createLandingFacilities($riggData) {
        $landingFacilities = new LandingFacilities();
        $landingFacilities->setHelideckType($riggData[72]);
        $landingFacilities->setHelideckSize($riggData[73]);
        return $landingFacilities;
    }

    /**
     * @param $riggData
     * @return LiftingEquipment
     */
    private function createLiftingEquipment($riggData) {
        $liftingEquipment = new LiftingEquipment();
        $liftingEquipment->setPedestalCrane1(str_replace([','], '.', $riggData[31]));
        $liftingEquipment->setPedestalCrane2(str_replace([','], '.', $riggData[32]));
        $liftingEquipment->setPedestalCrane3(str_replace([','], '.', $riggData[33]));
        $liftingEquipment->setPedestalCrane4(str_replace([','], '.', $riggData[34]));
        $liftingEquipment->setRiserHandlingCrane($riggData[35]);
        return $liftingEquipment;
    }

    /**
     * @param $riggData
     * @return MudSystems
     */
    private function createMudSystems($riggData) {
        $mudSystems = new MudSystems();
        $mudSystems->setMudPumpsNumber($riggData[48]);
        $mudSystems->setMudPumpsManufacturerAndModel($riggData[49]);
        $mudSystems->setLiquidMud(str_replace([',', ' '], '', $riggData[50]));
        $mudSystems->setFuelOil(str_replace([',', ' '], '', $riggData[51]));
        $mudSystems->setBulkStorageCapacity($riggData[52]);
        $mudSystems->setShaleShakers($riggData[53]);
        $mudSystems->setDesander($riggData[54]);
        $mudSystems->setDesilter($riggData[55]);
        return $mudSystems;
    }

    /**
     * @param $riggData
     * @return VesselParticulars
     */
    private function createVesselParticulars($riggData) {
        $vesselParticulars = new VesselParticulars();
        $vesselParticulars->setTotalVesselPower(str_replace([',', ' '], '', $riggData[15]));
        $vesselParticulars->setMaximumVesselSpeed($riggData[16]);
        $vesselParticulars->setQuartersCapacity($riggData[17]);
        $vesselParticulars->setLength($riggData[18]);
        $vesselParticulars->setWidth($riggData[19]);
        $vesselParticulars->setTransitDraft(str_replace([','], '.', $riggData[20]));
        $vesselParticulars->setOperationDraft($riggData[21]);
        $vesselParticulars->setMaximumVariableLoad($riggData[22]);
        $vesselParticulars->setMoonpoolSize($riggData[23]);
        return $vesselParticulars;
    }

    /**
     * @param $riggData
     * @return VesselParticularsContinued
     */
    private function createVesselParticularsContinued($riggData) {
        $vesselParticularsContinued = new VesselParticularsContinued();
        $vesselParticularsContinued->setThrusters($riggData[24]);
        $vesselParticularsContinued->setSizeOfChain($riggData[25]);
        $vesselParticularsContinued->setChainGrade($riggData[26]);
        $vesselParticularsContinued->setLengthOfChain($riggData[27]);
        $vesselParticularsContinued->setWireRopeDiameter($riggData[28]);
        $vesselParticularsContinued->setLengthOfWireRope($riggData[29]);
        $vesselParticularsContinued->setAnchorSize($riggData[30]);
        return $vesselParticularsContinued;
    }

    /**
     * @param $dm
     * @param $fileName
     * @param $gallery
     * @return GalleryItem
     */
    private function createGalleryItem($dm, $fileName, $gallery, $riggName)
    {
        $galleryItem = new GalleryItem();
        $media = $this->reUploadMedia($fileName, $dm, $riggName);
        $media->addGalleryItem($galleryItem);
        $galleryItem->setMedia($media);
        $gallery->addGalleryItem($galleryItem);
        $galleryItem->setEnabled(true);
        return $galleryItem;
    }

    /**
     * @param $csv_timeline
     * @return array
     */
    private function initializeCsvContracts($csv_timeline){
        $csvContracts = [];
        $lines = file($csv_timeline, FILE_IGNORE_NEW_LINES);
        foreach ($lines as $key => $value)
        {
            if($key) {
                $csvContracts[$key] = str_getcsv($value);
            }
        }
        unset($csvContracts[0]);
        return $csvContracts;
    }

    /**
     * @param $contracts
     * @param $riggId
     * @return array
     */
    private function getContractsByRiggId($contracts, $riggId) {
        $contractsByRiggId = [];
        foreach ($contracts as $contract) {
            if($contract[0] == $riggId) {
                $contractsByRiggId[] = $this->parse_contract($contract);
            }
        }
        usort($contractsByRiggId, [$this, 'sort_contracts']);
        $active_found = false;
        foreach ($contractsByRiggId as &$contract) {
            if (!$active_found && $this->checkDateInRange($contract)) {
                $contract['is_active'] = true;
                $active_found = true;
            }
            if (isset($contract['is_active']) && $contract['is_active']) {
                if ($contract['Type'] == 'Avvik') {
                    $contract['Status'] = $contract['Operator'];
                    $contract['Operator'] = '';
                } else {
                    $contract['Status'] = 'Active';
                }
            } else {
                if ($contract['Type'] == 'Avvik') {
                    $contract['Operator'] = '';
                }
                $contract['Status'] = '';
            }
        }
        return $contractsByRiggId;
    }

    /**
     * @param $contract
     * @return array
     */
    private function parse_contract($contract) {
        $data = [
            'Rigid' => $contract[0],
            'Rigname' => $contract[1],
            'Type' => $contract[2],
            'Operator' => $contract[3],
            'From_year' => trim($contract[4]),
            'From_month' => trim($contract[5]),
            'From_day' => trim($contract[6]),
            'To_year' => trim($contract[7]),
            'To_month' => trim($contract[8]),
            'To_day' => trim($contract[9]),
            'Dayrate' => $contract[10],
            'Comment' => $contract[11],
            'Last_Edited_On' => $contract[12],
            'Created_On' => $contract[13]
        ];
        return $data;
    }

    /**
     * @param $a1
     * @param $b1
     * @return int
     */
    private function sort_contracts($a1, $b1) {
        $a1['From_day'] = empty($a1['From_day']) ? 1 : $a1['From_day'];
        $b1['From_day'] = empty($b1['From_day']) ? 1 : $b1['From_day'];
        $a = mktime(0, 0, 0, intval($a1['From_day']), intval($a1['From_month']), intval($a1['From_year']));
        $b = mktime(0, 0, 0, intval($b1['From_day']), intval($b1['From_month']), intval($b1['From_year']));
        if ($a == $b) {
            return 0;
        }
        return ($a > $b) ? -1 : 1;
    }

    /**
     * @param $contract
     * @return bool
     */
    private function checkDateInRange($contract) {
        $daysCount = $this->daysInMonth($contract['To_month'], $contract['To_year']);
        $fromDate = DateTime::createFromFormat('d/n/Y', (($contract['From_day'] == '' ? '1' : $contract['From_day']) .
            '/' . $contract['From_month'] . '/' . $contract['From_year']));
        $toDate = DateTime::createFromFormat('d/n/Y', (($contract['To_day'] == '' ? $daysCount : $contract['To_day']) .
            '/' . $contract['To_month'] . '/' . $contract['To_year']));
        $now = new DateTime();
        return ($now >= $fromDate && $now <= $toDate);
    }

    /**
     * @param $month
     * @param $year
     * @return int
     */
    private function daysInMonth($month, $year)
    {
        // calculate number of days in a month
        return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
    }
}