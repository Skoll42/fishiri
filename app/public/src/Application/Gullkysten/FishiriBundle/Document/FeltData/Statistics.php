<?php

namespace Application\Gullkysten\FishiriBundle\Document\FeltData;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @MongoDB\EmbeddedDocument
 * @Gedmo\Loggable
 */
class Statistics
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $topWaterDepth;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $topInvestments;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $topRemainingInvestments;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $topOilDiscovery;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $topGasDiscovery;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $topRemainingOilReserves;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $topRemainingGasReserves;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $topRemainingCondensateReserves;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $topRemainingNglReserves;
    
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
    public function getTopWaterDepth()
    {
        return $this->topWaterDepth;
    }

    /**
     * @param integer $topWaterDepth
     */
    public function setTopWaterDepth($topWaterDepth)
    {
        $this->topWaterDepth = $topWaterDepth;
    }

    /**
     * @return integer
     */
    public function getTopInvestments()
    {
        return $this->topInvestments;
    }

    /**
     * @param integer $topInvestments
     */
    public function setTopInvestments($topInvestments)
    {
        $this->topInvestments = $topInvestments;
    }

    /**
     * @return integer
     */
    public function getTopRemainingInvestments()
    {
        return $this->topRemainingInvestments;
    }

    /**
     * @param integer $topRemainingInvestments
     */
    public function setTopRemainingInvestments($topRemainingInvestments)
    {
        $this->topRemainingInvestments = $topRemainingInvestments;
    }

    /**
     * @return integer
     */
    public function getTopOilDiscovery()
    {
        return $this->topOilDiscovery;
    }

    /**
     * @param integer $topOilDiscovery
     */
    public function setTopOilDiscovery($topOilDiscovery)
    {
        $this->topOilDiscovery = $topOilDiscovery;
    }

    /**
     * @return integer
     */
    public function getTopGasDiscovery()
    {
        return $this->topGasDiscovery;
    }

    /**
     * @param integer $topGasDiscovery
     */
    public function setTopGasDiscovery($topGasDiscovery)
    {
        $this->topGasDiscovery = $topGasDiscovery;
    }

    /**
     * @return integer
     */
    public function getTopRemainingOilReserves()
    {
        return $this->topRemainingOilReserves;
    }

    /**
     * @param integer $topRemainingOilReserves
     */
    public function setTopRemainingOilReserves($topRemainingOilReserves)
    {
        $this->topRemainingOilReserves = $topRemainingOilReserves;
    }

    /**
     * @return integer
     */
    public function getTopRemainingGasReserves()
    {
        return $this->topRemainingGasReserves;
    }

    /**
     * @param integer $topRemainingGasReserves
     */
    public function setTopRemainingGasReserves($topRemainingGasReserves)
    {
        $this->topRemainingGasReserves = $topRemainingGasReserves;
    }

    /**
     * @return integer
     */
    public function getTopRemainingCondensateReserves()
    {
        return $this->topRemainingCondensateReserves;
    }

    /**
     * @param integer $topRemainingCondensateReserves
     */
    public function setTopRemainingCondensateReserves($topRemainingCondensateReserves)
    {
        $this->topRemainingCondensateReserves = $topRemainingCondensateReserves;
    }

    /**
     * @return integer
     */
    public function getTopRemainingNglReserves()
    {
        return $this->topRemainingNglReserves;
    }

    /**
     * @param integer $topRemainingNglReserves
     */
    public function setTopRemainingNglReserves($topRemainingNglReserves)
    {
        $this->topRemainingNglReserves = $topRemainingNglReserves;
    }
}
