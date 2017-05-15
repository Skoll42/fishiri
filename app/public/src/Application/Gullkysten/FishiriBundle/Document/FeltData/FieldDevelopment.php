<?php

namespace Application\Gullkysten\FishiriBundle\Document\FeltData;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @MongoDB\EmbeddedDocument
 * @Gedmo\Loggable
 */
class FieldDevelopment
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $productionStructure;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $productionDrillingQuarters;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $material;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $additionalInfo;

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
    public function getProductionStructure()
    {
        return $this->productionStructure;
    }

    /**
     * @param string $productionStructure
     */
    public function setProductionStructure($productionStructure)
    {
        $this->productionStructure = $productionStructure;
    }

    /**
     * @return string
     */
    public function getProductionDrillingQuarters()
    {
        return $this->productionDrillingQuarters;
    }

    /**
     * @param string $productionDrillingQuarters
     */
    public function setProductionDrillingQuarters($productionDrillingQuarters)
    {
        $this->productionDrillingQuarters = $productionDrillingQuarters;
    }

    /**
     * @return string
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * @param string $material
     */
    public function setMaterial($material)
    {
        $this->material = $material;
    }

    /**
     * @return string
     */
    public function getAdditionalInfo()
    {
        return $this->additionalInfo;
    }

    /**
     * @param string $additionalInfo
     */
    public function setAdditionalInfo($additionalInfo)
    {
        $this->additionalInfo = $additionalInfo;
    }
}
