<?php

namespace Application\Gullkysten\FishiriBundle\Document\RiggData;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @MongoDB\EmbeddedDocument
 * @Gedmo\Loggable
 */
class LandingFacilities
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $helideckType;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $helideckSize;

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
    public function getHelideckType()
    {
        return $this->helideckType;
    }

    /**
     * @param string $helideckType
     */
    public function setHelideckType($helideckType)
    {
        $this->helideckType = $helideckType;
    }

    /**
     * @return string
     */
    public function getHelideckSize()
    {
        return $this->helideckSize;
    }

    /**
     * @param string $helideckSize
     */
    public function setHelideckSize($helideckSize)
    {
        $this->helideckSize = $helideckSize;
    }
}
