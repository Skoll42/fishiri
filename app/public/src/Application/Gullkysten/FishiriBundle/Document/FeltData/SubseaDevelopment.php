<?php

namespace Application\Gullkysten\FishiriBundle\Document\FeltData;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @MongoDB\EmbeddedDocument
 * @Gedmo\Loggable
 */
class SubseaDevelopment
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $subseaCompany;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $subseaTemplate;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $totalTrees;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $fmc;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $aks;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $ge;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $cam;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $subseaTieback;

    /**
     * @MongoDB\Integer
     * @Gedmo\Versioned
     */
    protected $tiebackDistance;

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
    public function getSubseaCompany()
    {
        return $this->subseaCompany;
    }

    /**
     * @param string $subseaCompany
     */
    public function setSubseaCompany($subseaCompany)
    {
        $this->subseaCompany = $subseaCompany;
    }

    /**
     * @return integer
     */
    public function getSubseaTemplate()
    {
        return $this->subseaTemplate;
    }

    /**
     * @param integer $subseaTemplate
     */
    public function setSubseaTemplate($subseaTemplate)
    {
        $this->subseaTemplate = $subseaTemplate;
    }

    /**
     * @return integer
     */
    public function getTotalTrees()
    {
        return $this->totalTrees;
    }

    /**
     * @param integer $totalTrees
     */
    public function setTotalTrees($totalTrees)
    {
        $this->totalTrees = $totalTrees;
    }

    /**
     * @return integer
     */
    public function getFmc()
    {
        return $this->fmc;
    }

    /**
     * @param integer $fmc
     */
    public function setFmc($fmc)
    {
        $this->fmc = $fmc;
    }

    /**
     * @return integer
     */
    public function getAks()
    {
        return $this->aks;
    }

    /**
     * @param integer $aks
     */
    public function setAks($aks)
    {
        $this->aks = $aks;
    }

    /**
     * @return integer
     */
    public function getGe()
    {
        return $this->ge;
    }

    /**
     * @param integer $ge
     */
    public function setGe($ge)
    {
        $this->ge = $ge;
    }

    /**
     * @return integer
     */
    public function getCam()
    {
        return $this->cam;
    }

    /**
     * @param integer $cam
     */
    public function setCam($cam)
    {
        $this->cam = $cam;
    }

    /**
     * @return string
     */
    public function getSubseaTieback()
    {
        return $this->subseaTieback;
    }

    /**
     * @param string $subseaTieback
     */
    public function setSubseaTieback($subseaTieback)
    {
        $this->subseaTieback = $subseaTieback;
    }

    /**
     * @return integer
     */
    public function getTiebackDistance()
    {
        return $this->tiebackDistance;
    }

    /**
     * @param integer $tiebackDistance
     */
    public function setTiebackDistance($tiebackDistance)
    {
        $this->tiebackDistance = $tiebackDistance;
    }
}
