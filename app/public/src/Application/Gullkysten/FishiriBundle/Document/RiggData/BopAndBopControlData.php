<?php

namespace Application\Gullkysten\FishiriBundle\Document\RiggData;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @MongoDB\EmbeddedDocument
 * @Gedmo\Loggable
 */
class BopAndBopControlData
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $bopOperatingPressure;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $ckLineSize;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $ramBopsNumber;

    /**
     * @MongoDB\String
     */
    protected $ramBopsManufacturer;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $annularBopsNumber;

    /**
     * @MongoDB\String
     */
    protected $annularBopsManufacturer;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $wellheadConnectorType;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $bopControlSystemType;

    /**
     * @MongoDB\String
     */
    protected $bopControlSystemManufacturer;
    
    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return integer
     */
    public function getBopOperatingPressure()
    {
        return $this->bopOperatingPressure;
    }

    /**
     * @param integer $bopOperatingPressure
     */
    public function setBopOperatingPressure($bopOperatingPressure)
    {
        $this->bopOperatingPressure = $bopOperatingPressure;
    }

    /**
     * @return float
     */
    public function getCkLineSize()
    {
        return $this->ckLineSize;
    }

    /**
     * @param float $ckLineSize
     */
    public function setCkLineSize($ckLineSize)
    {
        $this->ckLineSize = $ckLineSize;
    }

    /**
     * @return integer
     */
    public function getRamBopsNumber()
    {
        return $this->ramBopsNumber;
    }

    /**
     * @param integer $ramBopsNumber
     */
    public function setRamBopsNumber($ramBopsNumber)
    {
        $this->ramBopsNumber = $ramBopsNumber;
    }

    /**
     * @return string
     */
    public function getRamBopsManufacturer()
    {
        return $this->ramBopsManufacturer;
    }

    /**
     * @param string $ramBopsManufacturer
     */
    public function setRamBopsManufacturer($ramBopsManufacturer)
    {
        $this->ramBopsManufacturer = $ramBopsManufacturer;
    }

    /**
     * @return integer
     */
    public function getAnnularBopsNumber()
    {
        return $this->annularBopsNumber;
    }

    /**
     * @param integer $annularBopsNumber
     */
    public function setAnnularBopsNumber($annularBopsNumber)
    {
        $this->annularBopsNumber = $annularBopsNumber;
    }

    /**
     * @return string
     */
    public function getAnnularBopsManufacturer()
    {
        return $this->annularBopsManufacturer;
    }

    /**
     * @param string $annularBopsManufacturer
     */
    public function setAnnularBopsManufacturer($annularBopsManufacturer)
    {
        $this->annularBopsManufacturer = $annularBopsManufacturer;
    }

    /**
     * @return string
     */
    public function getWellheadConnectorType()
    {
        return $this->wellheadConnectorType;
    }

    /**
     * @param string $wellheadConnectorType
     */
    public function setWellheadConnectorType($wellheadConnectorType)
    {
        $this->wellheadConnectorType = $wellheadConnectorType;
    }

    /**
     * @return string
     */
    public function getBopControlSystemType()
    {
        return $this->bopControlSystemType;
    }

    /**
     * @param string $bopControlSystemType
     */
    public function setBopControlSystemType($bopControlSystemType)
    {
        $this->bopControlSystemType = $bopControlSystemType;
    }

    /**
     * @return string
     */
    public function getBopControlSystemManufacturer()
    {
        return $this->bopControlSystemManufacturer;
    }

    /**
     * @param string $bopControlSystemManufacturer
     */
    public function setBopControlSystemManufacturer($bopControlSystemManufacturer)
    {
        $this->bopControlSystemManufacturer = $bopControlSystemManufacturer;
    }
}
