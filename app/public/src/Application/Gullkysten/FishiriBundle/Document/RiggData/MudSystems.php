<?php

namespace Application\Gullkysten\FishiriBundle\Document\RiggData;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @MongoDB\EmbeddedDocument
 * @Gedmo\Loggable
 */
class MudSystems
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $mudPumpsNumber;

    /**
     * @MongoDB\String
     */
    protected $mudPumpsManufacturerAndModel;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $liquidMud;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $fuelOil;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $bulkStorageCapacity;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $shaleShakers;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $desander;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $desilter;
    
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
    public function getMudPumpsNumber()
    {
        return $this->mudPumpsNumber;
    }

    /**
     * @param integer $mudPumpsNumber
     */
    public function setMudPumpsNumber($mudPumpsNumber)
    {
        $this->mudPumpsNumber = $mudPumpsNumber;
    }

    /**
     * @return string
     */
    public function getMudPumpsManufacturerAndModel()
    {
        return $this->mudPumpsManufacturerAndModel;
    }

    /**
     * @param string $mudPumpsManufacturerAndModel
     */
    public function setMudPumpsManufacturerAndModel($mudPumpsManufacturerAndModel)
    {
        $this->mudPumpsManufacturerAndModel = $mudPumpsManufacturerAndModel;
    }

    /**
     * @return integer
     */
    public function getLiquidMud()
    {
        return $this->liquidMud;
    }

    /**
     * @param integer $liquidMud
     */
    public function setLiquidMud($liquidMud)
    {
        $this->liquidMud = $liquidMud;
    }

    /**
     * @return integer
     */
    public function getFuelOil()
    {
        return $this->fuelOil;
    }

    /**
     * @param integer $fuelOil
     */
    public function setFuelOil($fuelOil)
    {
        $this->fuelOil = $fuelOil;
    }

    /**
     * @return string
     */
    public function getBulkStorageCapacity()
    {
        return $this->bulkStorageCapacity;
    }

    /**
     * @param string $bulkStorageCapacity
     */
    public function setBulkStorageCapacity($bulkStorageCapacity)
    {
        $this->bulkStorageCapacity = $bulkStorageCapacity;
    }

    /**
     * @return integer
     */
    public function getShaleShakers()
    {
        return $this->shaleShakers;
    }

    /**
     * @param integer $shaleShakers
     */
    public function setShaleShakers($shaleShakers)
    {
        $this->shaleShakers = $shaleShakers;
    }

    /**
     * @return integer
     */
    public function getDesander()
    {
        return $this->desander;
    }

    /**
     * @param integer $desander
     */
    public function setDesander($desander)
    {
        $this->desander = $desander;
    }

    /**
     * @return integer
     */
    public function getDesilter()
    {
        return $this->desilter;
    }

    /**
     * @param integer $desilter
     */
    public function setDesilter($desilter)
    {
        $this->desilter = $desilter;
    }
}
