<?php

namespace Application\Gullkysten\FishiriBundle\Document\RiggData;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @MongoDB\EmbeddedDocument
 * @Gedmo\Loggable
 */
class DrillingEquipment
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $derrickRating;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $derrickManufacturer;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $derrickFootprint;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $drawworksPower;

    /**
     * @MongoDB\String
     */
    protected $drawworksManufacturer;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $drillLineSize;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $rotaryTableSize;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $ironRoughneck;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $topDrive;

    /**
     * @MongoDB\String
     */
    protected $heaveCompensatorManufacturer;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $heaveCompensatorCapacity;

    /**
     * @MongoDB\String
     */
    protected $pipeRackingSystem;

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
    public function getDerrickRating()
    {
        return $this->derrickRating;
    }

    /**
     * @param integer $derrickRating
     */
    public function setDerrickRating($derrickRating)
    {
        $this->derrickRating = $derrickRating;
    }

    /**
     * @return string
     */
    public function getDerrickManufacturer()
    {
        return $this->derrickManufacturer;
    }

    /**
     * @param string $derrickManufacturer
     */
    public function setDerrickManufacturer($derrickManufacturer)
    {
        $this->derrickManufacturer = $derrickManufacturer;
    }

    /**
     * @return string
     */
    public function getDerrickFootprint()
    {
        return $this->derrickFootprint;
    }

    /**
     * @param string $derrickFootprint
     */
    public function setDerrickFootprint($derrickFootprint)
    {
        $this->derrickFootprint = $derrickFootprint;
    }

    /**
     * @return integer
     */
    public function getDrawworksPower()
    {
        return $this->drawworksPower;
    }

    /**
     * @param integer $drawworksPower
     */
    public function setDrawworksPower($drawworksPower)
    {
        $this->drawworksPower = $drawworksPower;
    }

    /**
     * @return string
     */
    public function getDrawworksManufacturer()
    {
        return $this->drawworksManufacturer;
    }

    /**
     * @param string $drawworksManufacturer
     */
    public function setDrawworksManufacturer($drawworksManufacturer)
    {
        $this->drawworksManufacturer = $drawworksManufacturer;
    }

    /**
     * @return string
     */
    public function getDrillLineSize()
    {
        return $this->drillLineSize;
    }

    /**
     * @param string $drillLineSize
     */
    public function setDrillLineSize($drillLineSize)
    {
        $this->drillLineSize = $drillLineSize;
    }

    /**
     * @return string
     */
    public function getRotaryTableSize()
    {
        return $this->rotaryTableSize;
    }

    /**
     * @param string $rotaryTableSize
     */
    public function setRotaryTableSize($rotaryTableSize)
    {
        $this->rotaryTableSize = $rotaryTableSize;
    }

    /**
     * @return string
     */
    public function getIronRoughneck()
    {
        return $this->ironRoughneck;
    }

    /**
     * @param string $ironRoughneck
     */
    public function setIronRoughneck($ironRoughneck)
    {
        $this->ironRoughneck = $ironRoughneck;
    }

    /**
     * @return string
     */
    public function getTopDrive()
    {
        return $this->topDrive;
    }

    /**
     * @param string $topDrive
     */
    public function setTopDrive($topDrive)
    {
        $this->topDrive = $topDrive;
    }

    /**
     * @return string
     */
    public function getHeaveCompensatorManufacturer()
    {
        return $this->heaveCompensatorManufacturer;
    }

    /**
     * @param string $heaveCompensatorManufacturer
     */
    public function setHeaveCompensatorManufacturer($heaveCompensatorManufacturer)
    {
        $this->heaveCompensatorManufacturer = $heaveCompensatorManufacturer;
    }

    /**
     * @return string
     */
    public function getHeaveCompensatorCapacity()
    {
        return $this->heaveCompensatorCapacity;
    }

    /**
     * @param string $heaveCompensatorCapacity
     */
    public function setHeaveCompensatorCapacity($heaveCompensatorCapacity)
    {
        $this->heaveCompensatorCapacity = $heaveCompensatorCapacity;
    }

    /**
     * @return string
     */
    public function getPipeRackingSystem()
    {
        return $this->pipeRackingSystem;
    }

    /**
     * @param string $pipeRackingSystem
     */
    public function setPipeRackingSystem($pipeRackingSystem)
    {
        $this->pipeRackingSystem = $pipeRackingSystem;
    }
}
