<?php

namespace Application\Gullkysten\FishiriBundle\Document\FeltData;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @MongoDB\EmbeddedDocument
 * @Gedmo\Loggable
 */
class Investments
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $totalInvestments;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $remainingInvestments;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $soFarInvestments;

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
    public function getTotalInvestments()
    {
        return $this->totalInvestments;
    }

    /**
     * @param integer $totalInvestments
     */
    public function setTotalInvestments($totalInvestments)
    {
        $this->totalInvestments = $totalInvestments;
    }

    /**
     * @return integer
     */
    public function getRemainingInvestments()
    {
        return $this->remainingInvestments;
    }

    /**
     * @param integer $remainingInvestments
     */
    public function setRemainingInvestments($remainingInvestments)
    {
        $this->remainingInvestments = $remainingInvestments;
    }

    /**
     * @return integer
     */
    public function getSoFarInvestments()
    {
        return $this->soFarInvestments;
    }

    /**
     * @param integer $soFarInvestments
     */
    public function setSoFarInvestments($soFarInvestments)
    {
        $this->soFarInvestments = $soFarInvestments;
    }
}
