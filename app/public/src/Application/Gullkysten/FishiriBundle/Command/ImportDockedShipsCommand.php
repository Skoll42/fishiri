<?php

namespace Application\Gullkysten\FishiriBundle\Command;

use Application\Gullkysten\FishiriBundle\Document\DockedShips\DockedShips;
use Application\Gullkysten\FishiriBundle\Document\Owner;
use Application\Sonata\MediaBundle\Document\Media;
use DateTime;
use Exception;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ImportDockedShipsCommand
 * @package Application\Gullkysten\FishiriBundle\Command
 */
class ImportDockedShipsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('fishiri:gullkysten:dockedships:import')
            ->setDescription('Import Docked ships from csv file')
            ->addArgument(
                'file',
                InputArgument::REQUIRED,
                'Path to a file with Docked Ships to import'
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
        $dm = $this->getContainer()->get('doctrine_mongodb')->getManager();

        try {
            $dockedShips = $this->initializeCSV($pathToFile);
            foreach ($dockedShips as $dockedShip) {
                if($dockedShip[0] != '') {
                    $this->importDocuments($dockedShip, $dm);
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
        return $csvArray;
    }

    /**
     * @param $dockedShip
     * @param $dm
     */
    private function importDocuments($dockedShip, $dm) {
        if(!empty($dockedShip[1]) || !empty($dockedShip[9])) {
            $ownerName = $dockedShip[9] ? $dockedShip[9] : $dockedShip[1];
            if($ownerName) {
                $owner = $dm->getRepository('ApplicationGullkystenFishiriBundle:Owner')->findOneBy(['name' => $ownerName]);
                if (empty($owner)) {
                    $owner = new Owner();
                    $owner->setName($ownerName);
                    $dm->persist($owner);
                    $dm->flush();
                }


                $dockedShipObject = $dm->getRepository('ApplicationGullkystenFishiriBundle:DockedShips\DockedShips')->findOneBy(['name' => $dockedShip[0]]);
                if(empty($dockedShipObject)) {
                    $dockedShipObject = new DockedShips();
                }
                $dockedShipObject->setName($dockedShip[0]);
                $dockedShipObject->setOwner($owner);
                if ($dockedShip[2]) {
                    $coordinates = explode(',', $dockedShip[2]);
                    $dockedShipObject->setLatitude(trim($coordinates[0]));
                    $dockedShipObject->setLongitude(trim($coordinates[1]));
                    $dockedShipObject->setLocationName($this->retrieveLocationName($dockedShipObject->getLatitude(), $dockedShipObject->getLongitude()));
                }
                $dockedShipObject->setTypeSkip($dockedShip[3]);
                $dockedShipObject->setStatus($dockedShip[4]);
                try {
                    $dockedShipObject->setMedia($this->reUploadMedia($dockedShip[5], $dm, $dockedShip[0]));
                } catch (Exception $e) {
                    $dockedShipObject->setMedia(null);
                }
                $dockedShipObject->setFlagg($dockedShip[6]);
                $dockedShipObject->setDateIn(new \DateTime($dockedShip[7]));
                if($dockedShip[8]) {
                    $dockedShipObject->setDateOut(new \DateTime($dockedShip[8]));
                }
                $dm->persist($dockedShipObject);
            }
        }

        $dm->flush();
        $dm->clear();
    }

    /**
     * @param $latitude
     * @param $longitude
     * @return string
     */
    private function retrieveLocationName($latitude, $longitude)
    {
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$latitude.','.$longitude.'&key=AIzaSyBlEuonF3TdyimPM8t4V8HKcZ9SQRe9Oec&language=no';
        $json = @file_get_contents($url);
        $data=json_decode($json);
        return $data->status=="OK" ? $data->results[0]->formatted_address : 'Unsolvable location';
    }

    /**
     * @param $fileName
     * @param $dm
     * @param $shipName
     * @return Media
     */
    private function reUploadMedia($fileName, $dm, $shipName) {
        $date = new DateTime();
        $shipName = $this->slugify($shipName);
        $localTempFileName = 'web/uploads/tmp_'.$shipName.'_'.$date->getTimestamp().'.jpg';
        $this->downloadMedia($fileName, $localTempFileName);
        $file = new \Symfony\Component\HttpFoundation\File\File($localTempFileName);

        $provider = $this->getContainer()->get('sonata.media.provider.image');
        $media = new Media();
        $media->setBinaryContent($file);
        $media->setContext('default');
        $media->setProviderName('sonata.media.provider.image');
        $provider->transform($media);
        $provider->prePersist($media);
        $dm->persist($media);
        $provider->postPersist($media);
        $dm->flush();
        unlink($localTempFileName);
        return $media;
    }

    private function slugify($text) {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    /**
     * @param $fileName
     * @param $localTempFileName
     */
    private function downloadMedia($fileName, $localTempFileName) {
        $client = new \GuzzleHttp\Client();
        $client->request('GET', $fileName, ['sink' => $localTempFileName]);
    }
}