<?php

namespace Application\Gullkysten\FishiriBundle\Document\RiggData;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @MongoDB\EmbeddedDocument
 */
class RigInformation
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\String
     */
    protected $vesselType;

    /**
     * @MongoDB\String
     */
    protected $vesselDesign;

    /**
     * @MongoDB\String
     */
    protected $constructionDate;

    /**
     * @MongoDB\String
     */
    protected $upgradeDate;

    /**
     * @MongoDB\String
     */
    protected $classification;

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
    public function getVesselType()
    {
        return $this->vesselType;
    }

    /**
     * @param string $vesselType
     */
    public function setVesselType($vesselType)
    {
        $this->vesselType = $vesselType;
    }

    /**
     * @return string
     */
    public function getVesselDesign()
    {
        return $this->vesselDesign;
    }

    /**
     * @param string $vesselDesign
     */
    public function setVesselDesign($vesselDesign)
    {
        $this->vesselDesign = $vesselDesign;
    }

    /**
     * @return string
     */
    public function getConstructionDate()
    {
        return $this->constructionDate;
    }

    /**
     * @param string $constructionDate
     */
    public function setConstructionDate($constructionDate)
    {
        $this->constructionDate = $constructionDate;
    }

    /**
     * @return string
     */
    public function getUpgradeDate()
    {
        return $this->upgradeDate;
    }

    /**
     * @param string $upgradeDate
     */
    public function setUpgradeDate($upgradeDate)
    {
        $this->upgradeDate = $upgradeDate;
    }

    /**
     * @return string
     */
    public function getClassification()
    {
        return $this->classification;
    }

    /**
     * @param string $classification
     */
    public function setClassification($classification)
    {
        $this->classification = $classification;
    }
}
