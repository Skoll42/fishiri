<?php

namespace Application\Gullkysten\FishiriBundle\Document\FeltData;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @MongoDB\EmbeddedDocument
 * @Gedmo\Loggable
 */
class Npdid
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $owner;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $field;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $wellbore;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $company;

    /**
     * @MongoDB\String
     */
    protected $factsLink;

    /**
     * @MongoDB\String
     */
    protected $mapLink;

    /**
     * @MongoDB\Date
     * @Gedmo\Timestampable(on="update")
     */
    protected $lastUpdated;

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
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param integer $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return integer
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param integer $field
     */
    public function setField($field)
    {
        $this->field = $field;
    }

    /**
     * @return integer
     */
    public function getWellbore()
    {
        return $this->wellbore;
    }

    /**
     * @param integer $wellbore
     */
    public function setWellbore($wellbore)
    {
        $this->wellbore = $wellbore;
    }

    /**
     * @return integer
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param integer $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return \DateTime
     */
    public function getLastUpdated()
    {
        return $this->lastUpdated;
    }

    /**
     * @return mixed
     */
    public function getMapLink()
    {
        return $this->mapLink;
    }

    /**
     * @param mixed $mapLink
     */
    public function setMapLink($mapLink)
    {
        $this->mapLink = $mapLink;
    }

    /**
     * @return mixed
     */
    public function getFactsLink()
    {
        return $this->factsLink;
    }

    /**
     * @param mixed $factsLink
     */
    public function setFactsLink($factsLink)
    {
        $this->factsLink = $factsLink;
    }
}
