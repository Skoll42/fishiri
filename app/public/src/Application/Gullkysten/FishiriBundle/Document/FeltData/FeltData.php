<?php

namespace Application\Gullkysten\FishiriBundle\Document\FeltData;

use Application\Gullkysten\FishiriBundle\Document\DocumentInterface;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\SoftDeleteable\SoftDeleteable;

/**
 * @MongoDB\Document(
 *     collection="feltdata",
 *     repositoryClass="Application\Gullkysten\FishiriBundle\Repository\FeltDataRepository"
 * )
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @Gedmo\Loggable
 */
class FeltData implements DocumentInterface, SoftDeleteable
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\String
     * @Assert\NotBlank()
     * @Gedmo\Versioned
     */
    protected $name;

    /**
     * @MongoDB\ReferenceOne(
     *     targetDocument="Application\Gullkysten\FishiriBundle\Document\Operator",
     *     inversedBy="feltDatas",
     *     cascade={"persist"},
     *     nullable="true"
     * )
     * @Gedmo\Versioned
     */
    protected $operator;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $status;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $location;

    /**
     * @MongoDB\String
     */
    protected $description;

    /**
     * @MongoDB\Integer
     */
    protected $discoveryYear;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $onStream;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $productionLicense;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $waterDepth;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $supplyBase;

    /**
     * @MongoDB\EmbedOne(targetDocument="Application\Gullkysten\FishiriBundle\Document\FeltData\Investments")
     * @Gedmo\Versioned
     */
    protected $investments;

    /**
     * @MongoDB\EmbedOne(targetDocument="Application\Gullkysten\FishiriBundle\Document\FeltData\FrameAgreement")
     * @Gedmo\Versioned
     */
    protected $frameAgreement;

    /**
     * @MongoDB\EmbedOne(targetDocument="Application\Gullkysten\FishiriBundle\Document\FeltData\FieldDevelopment")
     * @Gedmo\Versioned
     */
    protected $fieldDevelopment;

    /**
     * @MongoDB\EmbedOne(targetDocument="Application\Gullkysten\FishiriBundle\Document\FeltData\SubseaDevelopment")
     * @Gedmo\Versioned
     */
    protected $subseaDevelopment;

    /**
     * @MongoDB\EmbedOne(targetDocument="Application\Gullkysten\FishiriBundle\Document\FeltData\DrillingWells")
     * @Gedmo\Versioned
     */
    protected $drillingWells;

    /**
     * @MongoDB\EmbedOne(targetDocument="Application\Gullkysten\FishiriBundle\Document\FeltData\RemainingReserves")
     * @Gedmo\Versioned
     */
    protected $remainingReserves;

    /**
     * @MongoDB\EmbedOne(targetDocument="Application\Gullkysten\FishiriBundle\Document\FeltData\TotalReservesEstimate")
     * @Gedmo\Versioned
     */
    protected $totalReservesEstimate;

    /**
     * @MongoDB\EmbedOne(targetDocument="Application\Gullkysten\FishiriBundle\Document\FeltData\ExportTechnology")
     * @Gedmo\Versioned
     */
    protected $exportTechnology;

    /**
     * @MongoDB\EmbedOne(targetDocument="Application\Gullkysten\FishiriBundle\Document\FeltData\Destination")
     * @Gedmo\Versioned
     */
    protected $destination;

    /**
     * @MongoDB\EmbedOne(targetDocument="Application\Gullkysten\FishiriBundle\Document\FeltData\Helicopter")
     * @Gedmo\Versioned
     */
    protected $helicopter;

    /**
     * @MongoDB\EmbedOne(targetDocument="Application\Gullkysten\FishiriBundle\Document\FeltData\Statistics")
     * @Gedmo\Versioned
     */
    protected $statistics;

    /**
     * @MongoDB\EmbedOne(targetDocument="Application\Gullkysten\FishiriBundle\Document\FeltData\Npdid")
     * @Gedmo\Versioned
     */
    protected $npdid;

    /**
     * @MongoDB\ReferenceOne(
     *     targetDocument="Application\Sonata\MediaBundle\Document\Gallery",
     *     cascade={"persist"},
     *     inversedBy="feltDatas",
     *     nullable="true")
     */
    protected $gallery;

    /**
     * @MongoDB\Date
     * @Gedmo\Timestampable(on="update")
     * @Assert\NotBlank()
     */
    protected $lastEdited;

    /**
     * @MongoDB\Date
     * @Gedmo\Timestampable(on="create")
     * @Assert\NotBlank()
     */
    protected $created;

    /**
     * @MongoDB\Date(nullable="true")
     */
    protected $deletedAt;

    /**
     * FeltData constructor.
     */
    public function __construct()
    {
    }

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return \Application\Gullkysten\FishiriBundle\Document\Operator
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @param \Application\Gullkysten\FishiriBundle\Document\Operator $operator
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return integer
     */
    public function getDiscoveryYear()
    {
        return $this->discoveryYear;
    }

    /**
     * @param integer $discoveryYear
     */
    public function setDiscoveryYear($discoveryYear)
    {
        $this->discoveryYear = $discoveryYear;
    }

    /**
     * @return integer
     */
    public function getOnStream()
    {
        return $this->onStream;
    }

    /**
     * @param integer $onStream
     */
    public function setOnStream($onStream)
    {
        $this->onStream = $onStream;
    }

    /**
     * @return string
     */
    public function getProductionLicense()
    {
        return $this->productionLicense;
    }

    /**
     * @param string $productionLicense
     */
    public function setProductionLicense($productionLicense)
    {
        $this->productionLicense = $productionLicense;
    }

    /**
     * @return integer
     */
    public function getWaterDepth()
    {
        return $this->waterDepth;
    }

    /**
     * @param integer $waterDepth
     */
    public function setWaterDepth($waterDepth)
    {
        $this->waterDepth = $waterDepth;
    }

    /**
     * @return string
     */
    public function getSupplyBase()
    {
        return $this->supplyBase;
    }

    /**
     * @param string $supplyBase
     */
    public function setSupplyBase($supplyBase)
    {
        $this->supplyBase = $supplyBase;
    }

    /**
     * @return \Application\Gullkysten\FishiriBundle\Document\FeltData\Investments
     */
    public function getInvestments()
    {
        return $this->investments;
    }

    /**
     * @param \Application\Gullkysten\FishiriBundle\Document\FeltData\Investments $investments
     */
    public function setInvestments($investments)
    {
        $this->investments = $investments;
    }

    /**
     * @return \Application\Gullkysten\FishiriBundle\Document\FeltData\FrameAgreement
     */
    public function getFrameAgreement()
    {
        return $this->frameAgreement;
    }

    /**
     * @param \Application\Gullkysten\FishiriBundle\Document\FeltData\FrameAgreement $frameAgreement
     */
    public function setFrameAgreement($frameAgreement)
    {
        $this->frameAgreement = $frameAgreement;
    }

    /**
     * @return \Application\Gullkysten\FishiriBundle\Document\FeltData\FieldDevelopment
     */
    public function getFieldDevelopment()
    {
        return $this->fieldDevelopment;
    }

    /**
     * @param $fieldDevelopment
     */
    public function setFieldDevelopment($fieldDevelopment)
    {
        $this->fieldDevelopment = $fieldDevelopment;
    }

    /**
     * @return \Application\Gullkysten\FishiriBundle\Document\FeltData\SubseaDevelopment
     */
    public function getSubseaDevelopment()
    {
        return $this->subseaDevelopment;
    }

    /**
     * @param \Application\Gullkysten\FishiriBundle\Document\FeltData\SubseaDevelopment $subseaDevelopment
     */
    public function setSubseaDevelopment($subseaDevelopment)
    {
        $this->subseaDevelopment = $subseaDevelopment;
    }

    /**
     * @return \Application\Gullkysten\FishiriBundle\Document\FeltData\DrillingWells
     */
    public function getDrillingWells()
    {
        return $this->drillingWells;
    }

    /**
     * @param \Application\Gullkysten\FishiriBundle\Document\FeltData\DrillingWells $drillingWells
     */
    public function setDrillingWells($drillingWells)
    {
        $this->drillingWells = $drillingWells;
    }

    /**
     * @return \Application\Gullkysten\FishiriBundle\Document\FeltData\RemainingReserves
     */
    public function getRemainingReserves()
    {
        return $this->remainingReserves;
    }

    /**
     * @param \Application\Gullkysten\FishiriBundle\Document\FeltData\RemainingReserves $remainingReserves
     */
    public function setRemainingReserves($remainingReserves)
    {
        $this->remainingReserves = $remainingReserves;
    }

    /**
     * @return \Application\Gullkysten\FishiriBundle\Document\FeltData\TotalReservesEstimate
     */
    public function getTotalReservesEstimate()
    {
        return $this->totalReservesEstimate;
    }

    /**
     * @param \Application\Gullkysten\FishiriBundle\Document\FeltData\TotalReservesEstimate $totalReservesEstimate
     */
    public function setTotalReservesEstimate($totalReservesEstimate)
    {
        $this->totalReservesEstimate = $totalReservesEstimate;
    }

    /**
     * @return \Application\Gullkysten\FishiriBundle\Document\FeltData\ExportTechnology
     */
    public function getExportTechnology()
    {
        return $this->exportTechnology;
    }

    /**
     * @param \Application\Gullkysten\FishiriBundle\Document\FeltData\ExportTechnology $exportTechnology
     */
    public function setExportTechnology($exportTechnology)
    {
        $this->exportTechnology = $exportTechnology;
    }

    /**
     * @return \Application\Gullkysten\FishiriBundle\Document\FeltData\Destination
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param \Application\Gullkysten\FishiriBundle\Document\FeltData\Destination $destination
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
    }

    /**
     * @return \Application\Gullkysten\FishiriBundle\Document\FeltData\Helicopter
     */
    public function getHelicopter()
    {
        return $this->helicopter;
    }

    /**
     * @param \Application\Gullkysten\FishiriBundle\Document\FeltData\Helicopter $helicopter
     */
    public function setHelicopter($helicopter)
    {
        $this->helicopter = $helicopter;
    }

    /**
     * @return \Application\Gullkysten\FishiriBundle\Document\FeltData\Statistics
     */
    public function getStatistics()
    {
        return $this->statistics;
    }

    /**
     * @param \Application\Gullkysten\FishiriBundle\Document\FeltData\Statistics $statistics
     */
    public function setStatistics($statistics)
    {
        $this->statistics = $statistics;
    }

    /**
     * @return \Application\Gullkysten\FishiriBundle\Document\FeltData\Npdid
     */
    public function getNpdid()
    {
        return $this->npdid;
    }

    /**
     * @param \Application\Gullkysten\FishiriBundle\Document\FeltData\Npdid $npdid
     */
    public function setNpdid($npdid)
    {
        $this->npdid = $npdid;
    }

    /**
     * @return \Application\Sonata\MediaBundle\Document\Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * @param \Application\Sonata\MediaBundle\Document\Gallery $gallery
     */
    public function setGallery($gallery)
    {
        $this->gallery = $gallery;
    }

    /**
     * @return \DateTime
     */
    public function getLastEdited()
    {
        return $this->lastEdited;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return mixed
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * @param $deletedAt
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }

    /**
     * @return mixed
     */
    public function getClassName()
    {
        $classCanonicalName = explode('\\', get_class($this));
        return end($classCanonicalName);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName() ? $this->getName() : '';
    }
}
