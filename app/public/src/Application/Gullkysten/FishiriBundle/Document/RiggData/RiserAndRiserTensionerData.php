<?php

namespace Application\Gullkysten\FishiriBundle\Document\RiggData;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @MongoDB\EmbeddedDocument
 * @Gedmo\Loggable
 */
class RiserAndRiserTensionerData
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $riserTensionersTotalCapacity;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $riserTensionersNumber;

    /**
     * @MongoDB\String
     */
    protected $riserTensionersManufacturer;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $diverterSize;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $riserSize;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $riserJointLength;

    /**
     * @MongoDB\String
     */
    protected $riserManufacturer;

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
    public function getRiserTensionersTotalCapacity()
    {
        return $this->riserTensionersTotalCapacity;
    }

    /**
     * @param integer $riserTensionersTotalCapacity
     */
    public function setRiserTensionersTotalCapacity($riserTensionersTotalCapacity)
    {
        $this->riserTensionersTotalCapacity = $riserTensionersTotalCapacity;
    }

    /**
     * @return integer
     */
    public function getRiserTensionersNumber()
    {
        return $this->riserTensionersNumber;
    }

    /**
     * @param integer $riserTensionersNumber
     */
    public function setRiserTensionersNumber($riserTensionersNumber)
    {
        $this->riserTensionersNumber = $riserTensionersNumber;
    }

    /**
     * @return string
     */
    public function getRiserTensionersManufacturer()
    {
        return $this->riserTensionersManufacturer;
    }

    /**
     * @param string $riserTensionersManufacturer
     */
    public function setRiserTensionersManufacturer($riserTensionersManufacturer)
    {
        $this->riserTensionersManufacturer = $riserTensionersManufacturer;
    }

    /**
     * @return string
     */
    public function getDiverterSize()
    {
        return $this->diverterSize;
    }

    /**
     * @param string $diverterSize
     */
    public function setDiverterSize($diverterSize)
    {
        $this->diverterSize = $diverterSize;
    }

    /**
     * @return string
     */
    public function getRiserSize()
    {
        return $this->riserSize;
    }

    /**
     * @param string $riserSize
     */
    public function setRiserSize($riserSize)
    {
        $this->riserSize = $riserSize;
    }

    /**
     * @return integer
     */
    public function getRiserJointLength()
    {
        return $this->riserJointLength;
    }

    /**
     * @param integer $riserJointLength
     */
    public function setRiserJointLength($riserJointLength)
    {
        $this->riserJointLength = $riserJointLength;
    }

    /**
     * @return string
     */
    public function getRiserManufacturer()
    {
        return $this->riserManufacturer;
    }

    /**
     * @param string $riserManufacturer
     */
    public function setRiserManufacturer($riserManufacturer)
    {
        $this->riserManufacturer = $riserManufacturer;
    }
}
