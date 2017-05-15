<?php

namespace Application\Gullkysten\FishiriBundle\Document\RiggData;

use Application\Gullkysten\FishiriBundle\Document\DocumentInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique as MongoDBUnique;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\SoftDeleteable\SoftDeleteable;

/**
 * @MongoDB\Document(
 *     collection="riggdata",
 *     repositoryClass="Application\Gullkysten\FishiriBundle\Repository\RiggDataRepository"
 * )
 * @MongoDBUnique(fields="rigId")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @Gedmo\Loggable
 */
class RiggData implements DocumentInterface, SoftDeleteable
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Integer
     * @Assert\NotBlank()
     * @Gedmo\Versioned
     */
    protected $rigId;

    /**
     * @MongoDB\String
     * @Assert\NotBlank()
     * @Gedmo\Versioned
     */
    protected $name;

    /**
     * @MongoDB\String
     * Enum({"Active", "Under construction", "Unknown", "Yard", "Idle"})
     * @Gedmo\Versioned
     */
    protected $status;

    /**
     * @MongoDB\ReferenceOne(
     *     targetDocument="Application\Gullkysten\FishiriBundle\Document\Owner",
     *     inversedBy="riggDatas",
     *     cascade={"persist"},
     *     nullable="true"
     * )
     * @Gedmo\Versioned
     */
    protected $owner;

    /**
     * @MongoDB\ReferenceOne(
     *     targetDocument="Application\Gullkysten\FishiriBundle\Document\Operator",
     *     inversedBy="riggDatas",
     *     cascade={"persist"},
     *     nullable="true"
     * )
     * @Gedmo\Versioned
     */
    protected $operator;

    /**
     * @MongoDB\String
     * Enum({"semisubmersible", "jackup"})
     * @Gedmo\Versioned
     */
    protected $type;
    
    /**
     * @MongoDB\EmbedOne(targetDocument="Application\Gullkysten\FishiriBundle\Document\RiggData\RigInformation")
     * @Gedmo\Versioned
     */
    protected $rigInformation;

    /**
     * @MongoDB\EmbedOne(targetDocument="Application\Gullkysten\FishiriBundle\Document\RiggData\RigRatings")
     * @Gedmo\Versioned
     */
    protected $rigRatings;

    /**
     * @var \Application\Gullkysten\FishiriBundle\Document\RiggData\ContractInformation[]
     * @MongoDB\ReferenceMany(
     *     targetDocument="Application\Gullkysten\FishiriBundle\Document\RiggData\ContractInformation",
     *     inversedBy="riggData",
     *     cascade={"persist"},
     *     nullable="true"
     * )
     */
    protected $contractInformation = [];

    /**
     * @MongoDB\EmbedOne(targetDocument="Application\Gullkysten\FishiriBundle\Document\RiggData\VesselParticulars")
     * @Gedmo\Versioned
     */
    protected $vesselParticulars;

    /**
     * @MongoDB\EmbedOne(
     *     targetDocument="Application\Gullkysten\FishiriBundle\Document\RiggData\VesselParticularsContinued"
     * )
     * @Gedmo\Versioned
     */
    protected $vesselParticularsContinued;

    /**
     * @MongoDB\EmbedOne(targetDocument="Application\Gullkysten\FishiriBundle\Document\RiggData\LiftingEquipment")
     * @Gedmo\Versioned
     */
    protected $liftingEquipment;

    /**
     * @MongoDB\EmbedOne(targetDocument="Application\Gullkysten\FishiriBundle\Document\RiggData\DrillingEquipment")
     * @Gedmo\Versioned
     */
    protected $drillingEquipment;

    /**
     * @MongoDB\EmbedOne(targetDocument="Application\Gullkysten\FishiriBundle\Document\RiggData\MudSystems")
     * @Gedmo\Versioned
     */
    protected $mudSystems;

    /**
     * @MongoDB\EmbedOne(
     *     targetDocument="Application\Gullkysten\FishiriBundle\Document\RiggData\RiserAndRiserTensionerData"
     * )
     * @Gedmo\Versioned
     */
    protected $riserAndRiserTensionerData;

    /**
     * @MongoDB\EmbedOne(targetDocument="Application\Gullkysten\FishiriBundle\Document\RiggData\BopAndBopControlData")
     * @Gedmo\Versioned
     */
    protected $bopAndBopControlData;

    /**
     * @MongoDB\EmbedOne(targetDocument="Application\Gullkysten\FishiriBundle\Document\RiggData\LandingFacilities")
     * @Gedmo\Versioned
     */
    protected $landingFacilities;

    /**
     * @MongoDB\ReferenceOne(
     *     targetDocument="Application\Sonata\MediaBundle\Document\Gallery",
     *     cascade={"persist"},
     *     inversedBy="riggDatas",
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
     * RiggData constructor.
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
     * @return integer
     */
    public function getRigId()
    {
        return $this->rigId;
    }

    /**
     * @param integer $rigId
     */
    public function setRigId($rigId)
    {
        $this->rigId = $rigId;
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
     * @return \Application\Gullkysten\FishiriBundle\Document\Owner
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param \Application\Gullkysten\FishiriBundle\Document\Owner $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return \Application\Gullkysten\FishiriBundle\Document\RiggData\RigInformation
     */
    public function getRigInformation()
    {
        return $this->rigInformation;
    }

    /**
     * @param \Application\Gullkysten\FishiriBundle\Document\RiggData\RigInformation $rigInformation
     */
    public function setRigInformation($rigInformation)
    {
        $this->rigInformation = $rigInformation;
    }

    /**
     * @return \Application\Gullkysten\FishiriBundle\Document\RiggData\RigRatings
     */
    public function getRigRatings()
    {
        return $this->rigRatings;
    }

    /**
     * @param \Application\Gullkysten\FishiriBundle\Document\RiggData\RigRatings $rigRatings
     */
    public function setRigRatings($rigRatings)
    {
        $this->rigRatings = $rigRatings;
    }

    /**
     * @return \Application\Gullkysten\FishiriBundle\Document\RiggData\ContractInformation
     */
    public function getContractInformation()
    {
        return $this->contractInformation;
    }

    /**
     * @param \Application\Gullkysten\FishiriBundle\Document\RiggData\ContractInformation[] $contractInformation
     */
    public function setContractInformation($contractInformation)
    {
        $this->contractInformation = new ArrayCollection();

        foreach ($contractInformation as $contract) {
            $this->addContractInformation($contract);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addContractInformation(ContractInformation $contract)
    {
        $contract->setRiggData($this);
        $this->contractInformation[] = $contract;
    }

    /**
     * @return \Application\Gullkysten\FishiriBundle\Document\RiggData\VesselParticulars
     */
    public function getVesselParticulars()
    {
        return $this->vesselParticulars;
    }

    /**
     * @param \Application\Gullkysten\FishiriBundle\Document\RiggData\VesselParticulars $vesselParticulars
     */
    public function setVesselParticulars($vesselParticulars)
    {
        $this->vesselParticulars = $vesselParticulars;
    }

    /**
     * @return \Application\Gullkysten\FishiriBundle\Document\RiggData\VesselParticularsContinued
     */
    public function getVesselParticularsContinued()
    {
        return $this->vesselParticularsContinued;
    }

    /**
     * @param \Application\Gullkysten\FishiriBundle\Document\RiggData\VesselParticularsContinued
     * $vesselParticularsContinued
     */
    public function setVesselParticularsContinued($vesselParticularsContinued)
    {
        $this->vesselParticularsContinued = $vesselParticularsContinued;
    }

    /**
     * @return \Application\Gullkysten\FishiriBundle\Document\RiggData\LiftingEquipment
     */
    public function getLiftingEquipment()
    {
        return $this->liftingEquipment;
    }

    /**
     * @param \Application\Gullkysten\FishiriBundle\Document\RiggData\LiftingEquipment $liftingEquipment
     */
    public function setLiftingEquipment($liftingEquipment)
    {
        $this->liftingEquipment = $liftingEquipment;
    }

    /**
     * @return \Application\Gullkysten\FishiriBundle\Document\RiggData\DrillingEquipment
     */
    public function getDrillingEquipment()
    {
        return $this->drillingEquipment;
    }

    /**
     * @param \Application\Gullkysten\FishiriBundle\Document\RiggData\DrillingEquipment $drillingEquipment
     */
    public function setDrillingEquipment($drillingEquipment)
    {
        $this->drillingEquipment = $drillingEquipment;
    }

    /**
     * @return \Application\Gullkysten\FishiriBundle\Document\RiggData\MudSystems
     */
    public function getMudSystems()
    {
        return $this->mudSystems;
    }

    /**
     * @param \Application\Gullkysten\FishiriBundle\Document\RiggData\MudSystems $mudSystems
     */
    public function setMudSystems($mudSystems)
    {
        $this->mudSystems = $mudSystems;
    }

    /**
     * @return \Application\Gullkysten\FishiriBundle\Document\RiggData\RiserAndRiserTensionerData
     */
    public function getRiserAndRiserTensionerData()
    {
        return $this->riserAndRiserTensionerData;
    }

    /**
     * @param \Application\Gullkysten\FishiriBundle\Document\RiggData\RiserAndRiserTensionerData
     * $riserAndRiserTensionerData
     */
    public function setRiserAndRiserTensionerData($riserAndRiserTensionerData)
    {
        $this->riserAndRiserTensionerData = $riserAndRiserTensionerData;
    }

    /**
     * @return \Application\Gullkysten\FishiriBundle\Document\RiggData\BopAndBopControlData
     */
    public function getBopAndBopControlData()
    {
        return $this->bopAndBopControlData;
    }

    /**
     * @param \Application\Gullkysten\FishiriBundle\Document\RiggData\BopAndBopControlData $bopAndBopControlData
     */
    public function setBopAndBopControlData($bopAndBopControlData)
    {
        $this->bopAndBopControlData = $bopAndBopControlData;
    }

    /**
     * @return \Application\Gullkysten\FishiriBundle\Document\RiggData\LandingFacilities
     */
    public function getLandingFacilities()
    {
        return $this->landingFacilities;
    }

    /**
     * @param \Application\Gullkysten\FishiriBundle\Document\RiggData\LandingFacilities $landingFacilities
     */
    public function setLandingFacilities($landingFacilities)
    {
        $this->landingFacilities = $landingFacilities;
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
