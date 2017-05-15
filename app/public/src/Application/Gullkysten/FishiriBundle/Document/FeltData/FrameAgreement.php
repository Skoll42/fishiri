<?php

namespace Application\Gullkysten\FishiriBundle\Document\FeltData;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @MongoDB\EmbeddedDocument
 * @Gedmo\Loggable
 */
class FrameAgreement
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $mm;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $mmContractExpires;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $iso;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $isoContractExpires;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $drillingAndWell;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $drillingAndWellContractExpires;

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
    public function getMm()
    {
        return $this->mm;
    }

    /**
     * @param string $mm
     */
    public function setMm($mm)
    {
        $this->mm = $mm;
    }

    /**
     * @return integer
     */
    public function getMmContractExpires()
    {
        return $this->mmContractExpires;
    }

    /**
     * @param integer $mmContractExpires
     */
    public function setMmContractExpires($mmContractExpires)
    {
        $this->mmContractExpires = $mmContractExpires;
    }

    /**
     * @return string
     */
    public function getIso()
    {
        return $this->iso;
    }

    /**
     * @param string $iso
     */
    public function setIso($iso)
    {
        $this->iso = $iso;
    }

    /**
     * @return integer
     */
    public function getIsoContractExpires()
    {
        return $this->isoContractExpires;
    }

    /**
     * @param integer $isoContractExpires
     */
    public function setIsoContractExpires($isoContractExpires)
    {
        $this->isoContractExpires = $isoContractExpires;
    }

    /**
     * @return string
     */
    public function getDrillingAndWell()
    {
        return $this->drillingAndWell;
    }

    /**
     * @param string $drillingAndWell
     */
    public function setDrillingAndWell($drillingAndWell)
    {
        $this->drillingAndWell = $drillingAndWell;
    }

    /**
     * @return integer
     */
    public function getDrillingAndWellContractExpires()
    {
        return $this->drillingAndWellContractExpires;
    }

    /**
     * @param integer $drillingAndWellContractExpires
     */
    public function setDrillingAndWellContractExpires($drillingAndWellContractExpires)
    {
        $this->drillingAndWellContractExpires = $drillingAndWellContractExpires;
    }
}
