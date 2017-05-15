<?php

namespace Application\Gullkysten\FishiriBundle\Document\FeltData;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @MongoDB\EmbeddedDocument
 * @Gedmo\Loggable
 */
class Destination
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $oil;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $gas;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $condensate;

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
    public function getOil()
    {
        return $this->oil;
    }

    /**
     * @param string $oil
     */
    public function setOil($oil)
    {
        $this->oil = $oil;
    }

    /**
     * @return string
     */
    public function getGas()
    {
        return $this->gas;
    }

    /**
     * @param string $gas
     */
    public function setGas($gas)
    {
        $this->gas = $gas;
    }

    /**
     * @return string
     */
    public function getCondensate()
    {
        return $this->condensate;
    }

    /**
     * @param string $condensate
     */
    public function setCondensate($condensate)
    {
        $this->condensate = $condensate;
    }
}
