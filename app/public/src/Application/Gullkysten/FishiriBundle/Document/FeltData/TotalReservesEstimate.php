<?php

namespace Application\Gullkysten\FishiriBundle\Document\FeltData;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @MongoDB\EmbeddedDocument
 * @Gedmo\Loggable
 */
class TotalReservesEstimate
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $oil;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $gas;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $condensate;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $ngl;

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
    public function getOil()
    {
        return $this->oil;
    }

    /**
     * @param integer $oil
     */
    public function setOil($oil)
    {
        $this->oil = $oil;
    }

    /**
     * @return integer
     */
    public function getGas()
    {
        return $this->gas;
    }

    /**
     * @param integer $gas
     */
    public function setGas($gas)
    {
        $this->gas = $gas;
    }

    /**
     * @return integer
     */
    public function getCondensate()
    {
        return $this->condensate;
    }

    /**
     * @param integer $condensate
     */
    public function setCondensate($condensate)
    {
        $this->condensate = $condensate;
    }

    /**
     * @return integer
     */
    public function getNgl()
    {
        return $this->ngl;
    }

    /**
     * @param integer $ngl
     */
    public function setNgl($ngl)
    {
        $this->ngl = $ngl;
    }
}
