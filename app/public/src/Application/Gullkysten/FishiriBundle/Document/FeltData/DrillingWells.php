<?php

namespace Application\Gullkysten\FishiriBundle\Document\FeltData;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @MongoDB\EmbeddedDocument
 * @Gedmo\Loggable
 */
class DrillingWells
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $exploration;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $development;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $topReservoirDepth;

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
    public function getExploration()
    {
        return $this->exploration;
    }

    /**
     * @param integer $exploration
     */
    public function setExploration($exploration)
    {
        $this->exploration = $exploration;
    }

    /**
     * @return integer
     */
    public function getDevelopment()
    {
        return $this->development;
    }

    /**
     * @param integer $development
     */
    public function setDevelopment($development)
    {
        $this->development = $development;
    }

    /**
     * @return integer
     */
    public function getTopReservoirDepth()
    {
        return $this->topReservoirDepth;
    }

    /**
     * @param integer $topReservoirDepth
     */
    public function setTopReservoirDepth($topReservoirDepth)
    {
        $this->topReservoirDepth = $topReservoirDepth;
    }
}
