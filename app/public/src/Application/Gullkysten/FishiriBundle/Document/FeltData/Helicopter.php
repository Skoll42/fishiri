<?php

namespace Application\Gullkysten\FishiriBundle\Document\FeltData;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @MongoDB\EmbeddedDocument
 * @Gedmo\Loggable
 */
class Helicopter
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $flightService;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $flightBase;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $offshoreBased;
    
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
    public function getFlightService()
    {
        return $this->flightService;
    }

    /**
     * @param string $flightService
     */
    public function setFlightService($flightService)
    {
        $this->flightService = $flightService;
    }

    /**
     * @return string
     */
    public function getFlightBase()
    {
        return $this->flightBase;
    }

    /**
     * @param string $flightBase
     */
    public function setFlightBase($flightBase)
    {
        $this->flightBase = $flightBase;
    }

    /**
     * @return string
     */
    public function getOffshoreBased()
    {
        return $this->offshoreBased;
    }

    /**
     * @param string $offshoreBased
     */
    public function setOffshoreBased($offshoreBased)
    {
        $this->offshoreBased = $offshoreBased;
    }
}
