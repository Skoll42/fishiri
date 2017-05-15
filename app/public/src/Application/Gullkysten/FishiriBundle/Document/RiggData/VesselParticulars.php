<?php

namespace Application\Gullkysten\FishiriBundle\Document\RiggData;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @MongoDB\EmbeddedDocument
 * @Gedmo\Loggable
 */
class VesselParticulars
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $totalVesselPower;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $maximumVesselSpeed;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $quartersCapacity;

    /**
     * @MongoDB\Float
     * @Gedmo\Versioned
     */
    protected $length;

    /**
     * @MongoDB\Float
     * @Gedmo\Versioned
     */
    protected $width;

    /**
     * @MongoDB\Float
     * @Gedmo\Versioned
     */
    protected $transitDraft;

    /**
     * @MongoDB\Float
     * @Gedmo\Versioned
     */
    protected $operationDraft;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $maximumVariableLoad;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $moonpoolSize;

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
    public function getTotalVesselPower()
    {
        return $this->totalVesselPower;
    }

    /**
     * @param integer $totalVesselPower
     */
    public function setTotalVesselPower($totalVesselPower)
    {
        $this->totalVesselPower = $totalVesselPower;
    }

    /**
     * @return string
     */
    public function getMaximumVesselSpeed()
    {
        return $this->maximumVesselSpeed;
    }

    /**
     * @param string $maximumVesselSpeed
     */
    public function setMaximumVesselSpeed($maximumVesselSpeed)
    {
        $this->maximumVesselSpeed = $maximumVesselSpeed;
    }

    /**
     * @return string
     */
    public function getQuartersCapacity()
    {
        return $this->quartersCapacity;
    }

    /**
     * @param string $quartersCapacity
     */
    public function setQuartersCapacity($quartersCapacity)
    {
        $this->quartersCapacity = $quartersCapacity;
    }

    /**
     * @return float
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param float $length
     */
    public function setLength($length)
    {
        $this->length = $length;
    }

    /**
     * @return float
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param float $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return float
     */
    public function getTransitDraft()
    {
        return $this->transitDraft;
    }

    /**
     * @param float $transitDraft
     */
    public function setTransitDraft($transitDraft)
    {
        $this->transitDraft = $transitDraft;
    }

    /**
     * @return float
     */
    public function getOperationDraft()
    {
        return $this->operationDraft;
    }

    /**
     * @param float $operationDraft
     */
    public function setOperationDraft($operationDraft)
    {
        $this->operationDraft = $operationDraft;
    }

    /**
     * @return string
     */
    public function getMaximumVariableLoad()
    {
        return $this->maximumVariableLoad;
    }

    /**
     * @param string $maximumVariableLoad
     */
    public function setMaximumVariableLoad($maximumVariableLoad)
    {
        $this->maximumVariableLoad = $maximumVariableLoad;
    }

    /**
     * @return string
     */
    public function getMoonpoolSize()
    {
        return $this->moonpoolSize;
    }

    /**
     * @param string $moonpoolSize
     */
    public function setMoonpoolSize($moonpoolSize)
    {
        $this->moonpoolSize = $moonpoolSize;
    }
}
