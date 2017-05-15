<?php

namespace Application\Gullkysten\FishiriBundle\Document\RiggData;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @MongoDB\EmbeddedDocument
 * @Gedmo\Loggable
 */
class VesselParticularsContinued
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $thrusters;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $sizeOfChain;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $chainGrade;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $lengthOfChain;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $wireRopeDiameter;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $lengthOfWireRope;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $anchorSize;

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
     * @return string
     */
    public function getThrusters()
    {
        return $this->thrusters;
    }

    /**
     * @param string $thrusters
     */
    public function setThrusters($thrusters)
    {
        $this->thrusters = $thrusters;
    }

    /**
     * @return string
     */
    public function getSizeOfChain()
    {
        return $this->sizeOfChain;
    }

    /**
     * @param string $sizeOfChain
     */
    public function setSizeOfChain($sizeOfChain)
    {
        $this->sizeOfChain = $sizeOfChain;
    }

    /**
     * @return string
     */
    public function getChainGrade()
    {
        return $this->chainGrade;
    }

    /**
     * @param string $chainGrade
     */
    public function setChainGrade($chainGrade)
    {
        $this->chainGrade = $chainGrade;
    }

    /**
     * @return integer
     */
    public function getLengthOfChain()
    {
        return $this->lengthOfChain;
    }

    /**
     * @param integer $lengthOfChain
     */
    public function setLengthOfChain($lengthOfChain)
    {
        $this->lengthOfChain = $lengthOfChain;
    }

    /**
     * @return string
     */
    public function getWireRopeDiameter()
    {
        return $this->wireRopeDiameter;
    }

    /**
     * @param string $wireRopeDiameter
     */
    public function setWireRopeDiameter($wireRopeDiameter)
    {
        $this->wireRopeDiameter = $wireRopeDiameter;
    }

    /**
     * @return integer
     */
    public function getLengthOfWireRope()
    {
        return $this->lengthOfWireRope;
    }

    /**
     * @param integer $lengthOfWireRope
     */
    public function setLengthOfWireRope($lengthOfWireRope)
    {
        $this->lengthOfWireRope = $lengthOfWireRope;
    }

    /**
     * @return string
     */
    public function getAnchorSize()
    {
        return $this->anchorSize;
    }

    /**
     * @param string $anchorSize
     */
    public function setAnchorSize($anchorSize)
    {
        $this->anchorSize = $anchorSize;
    }
}
