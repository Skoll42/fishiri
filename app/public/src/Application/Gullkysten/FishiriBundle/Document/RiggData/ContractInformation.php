<?php

namespace Application\Gullkysten\FishiriBundle\Document\RiggData;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @MongoDB\Document(
 *     collection="contract_information"
 * )
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @Gedmo\Loggable
 */
class ContractInformation
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\String
     * Enum({
     * "Active",
     * "Suspended",
     * "Stacked",
     * "Idle",
     * "Cold stacked",
     * "Retired",
     * "Yard",
     * "Ready stacked",
     * "Warm stacked",
     * "Under construction",
     * "Cancelled"})
     * @Gedmo\Versioned
     */
    protected $status;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $type;

    /**
     * @MongoDB\Date
     * @Gedmo\Versioned
     */
    protected $contractStarted;

    /**
     * @MongoDB\Date()
     * @Gedmo\Versioned
     */
    protected $contractExpires;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $sector;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $operator;

    /**
     * @MongoDB\Int
     * @Gedmo\Versioned
     */
    protected $dayRate;

    /**
     * @MongoDB\String
     */
    protected $comment;

    /**
     * @MongoDB\ReferenceOne(
     *     targetDocument="Application\Gullkysten\FishiriBundle\Document\RiggData\RiggData",
     *     mappedBy="contractInformation",
     *     nullable="true"
     * )
     */
    protected $riggData;

    /**
     * @MongoDB\Date(nullable="true")
     */
    protected $deletedAt;

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
    public function getContractExpires()
    {
        return $this->contractExpires;
    }

    /**
     * @param $contractExpires
     */
    public function setContractExpires($contractExpires)
    {
        $this->contractExpires = $contractExpires;
    }
    
    /**
     * @return string
     */
    public function getContractStarted()
    {
        return $this->contractStarted;
    }

    /**
     * @param $contractStarted
     */
    public function setContractStarted($contractStarted)
    {
        $this->contractStarted = $contractStarted;
    }
    
    /**
     * @return string
     */
    public function getSector()
    {
        return $this->sector;
    }

    /**
     * @param string $sector
     */
    public function setSector($sector)
    {
        $this->sector = $sector;
    }

    /**
     * @return integer
     */
    public function getDayRate()
    {
        return $this->dayRate;
    }

    /**
     * @param integer $dayRate
     */
    public function setDayRate($dayRate)
    {
        $this->dayRate = $dayRate;
    }

    /**
     * @return RiggData
     */
    public function getRiggData()
    {
        return $this->riggData;
    }

    /**
     * @param RiggData|null $riggData
     */
    public function setRiggData(RiggData $riggData = null)
    {
        $this->riggData = $riggData;
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
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @param mixed $operator
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;
    }
}
