<?php

namespace Application\Gullkysten\FishiriBundle\Document\RiggData;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @MongoDB\EmbeddedDocument
 * @Gedmo\Loggable
 */
class RigRatings
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $maximumWaterDepth;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $maximumDrillingDepth;

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
    public function getMaximumWaterDepth()
    {
        return $this->maximumWaterDepth;
    }

    /**
     * @param integer $maximumWaterDepth
     */
    public function setMaximumWaterDepth($maximumWaterDepth)
    {
        $this->maximumWaterDepth = $maximumWaterDepth;
    }

    /**
     * @return integer
     */
    public function getMaximumDrillingDepth()
    {
        return $this->maximumDrillingDepth;
    }

    /**
     * @param integer $maximumDrillingDepth
     */
    public function setMaximumDrillingDepth($maximumDrillingDepth)
    {
        $this->maximumDrillingDepth = $maximumDrillingDepth;
    }
}
