<?php

namespace Application\Gullkysten\FishiriBundle\Document\RiggData;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @MongoDB\EmbeddedDocument
 * @Gedmo\Loggable
 */
class LiftingEquipment
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Float
     * @Gedmo\Versioned
     */
    protected $pedestalCrane1;

    /**
     * @MongoDB\Float
     * @Gedmo\Versioned
     */
    protected $pedestalCrane2;

    /**
     * @MongoDB\Float
     * @Gedmo\Versioned
     */
    protected $pedestalCrane3;

    /**
     * @MongoDB\Float
     * @Gedmo\Versioned
     */
    protected $pedestalCrane4;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $riserHandlingCrane;

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
     * @return float
     */
    public function getPedestalCrane1()
    {
        return $this->pedestalCrane1;
    }

    /**
     * @param float $pedestalCrane1
     */
    public function setPedestalCrane1($pedestalCrane1)
    {
        $this->pedestalCrane1 = $pedestalCrane1;
    }

    /**
     * @return float
     */
    public function getPedestalCrane2()
    {
        return $this->pedestalCrane2;
    }

    /**
     * @param float $pedestalCrane2
     */
    public function setPedestalCrane2($pedestalCrane2)
    {
        $this->pedestalCrane2 = $pedestalCrane2;
    }

    /**
     * @return float
     */
    public function getPedestalCrane3()
    {
        return $this->pedestalCrane3;
    }

    /**
     * @param float $pedestalCrane3
     */
    public function setPedestalCrane3($pedestalCrane3)
    {
        $this->pedestalCrane3 = $pedestalCrane3;
    }

    /**
     * @return float
     */
    public function getPedestalCrane4()
    {
        return $this->pedestalCrane4;
    }

    /**
     * @param float $pedestalCrane4
     */
    public function setPedestalCrane4($pedestalCrane4)
    {
        $this->pedestalCrane4 = $pedestalCrane4;
    }

    /**
     * @return string
     */
    public function getRiserHandlingCrane()
    {
        return $this->riserHandlingCrane;
    }

    /**
     * @param string $riserHandlingCrane
     */
    public function setRiserHandlingCrane($riserHandlingCrane)
    {
        $this->riserHandlingCrane = $riserHandlingCrane;
    }
}
