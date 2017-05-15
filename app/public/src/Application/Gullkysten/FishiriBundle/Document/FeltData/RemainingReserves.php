<?php

namespace Application\Gullkysten\FishiriBundle\Document\FeltData;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @MongoDB\EmbeddedDocument
 * @Gedmo\Loggable
 */
class RemainingReserves
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
    protected $oilBarrels;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $atCurrentOilPrice;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $gas;

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
    public function getOilBarrels()
    {
        return $this->oilBarrels;
    }

    /**
     * @param integer $oilBarrels
     */
    public function setOilBarrels($oilBarrels)
    {
        $this->oilBarrels = $oilBarrels;
    }

    /**
     * @return integer
     */
    public function getAtCurrentOilPrice()
    {
        return $this->atCurrentOilPrice;
    }

    /**
     * @param integer $atCurrentOilPrice
     */
    public function setAtCurrentOilPrice($atCurrentOilPrice)
    {
        $this->atCurrentOilPrice = $atCurrentOilPrice;
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
}
