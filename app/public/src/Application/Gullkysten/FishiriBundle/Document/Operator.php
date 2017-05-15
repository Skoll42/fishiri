<?php

namespace Application\Gullkysten\FishiriBundle\Document;

use Application\Gullkysten\FishiriBundle\Document\FeltData\FeltData;
use Application\Gullkysten\FishiriBundle\Document\RiggData\RiggData;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\SoftDeleteable;
use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique as MongoDBUnique;

/**
 * @MongoDB\Document(collection="operators")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @MongoDBUnique(fields="name")
 */
class Operator implements DocumentInterface, SoftDeleteable
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\String
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @MongoDB\Date(nullable="true")
     */
    protected $deletedAt;

    /**
     * @MongoDB\ReferenceMany(targetDocument="Application\Gullkysten\FishiriBundle\Document\FeltData\FeltData", mappedBy="operator", nullable="true")
     * @Gedmo\ReferenceIntegrity("nullify")
     * @Serializer\Groups({"inclFeltDatas"})
     */
    protected $feltDatas = [];

    /**
     * @MongoDB\ReferenceMany(targetDocument="Application\Gullkysten\FishiriBundle\Document\RiggData\RiggData", mappedBy="operator", nullable="true")
     * @Gedmo\ReferenceIntegrity("nullify")
     * @Serializer\Groups({"inclRiggDatas"})
     */
    protected $riggDatas = [];

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * @param $deletedAt
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }

    /**
     * @return mixed
     */
    public function getClassName()
    {
        $classCanonicalName = explode('\\', get_class($this));
        return end($classCanonicalName);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName() ? $this->getName() : '';
    }

    /**
     * {@inheritdoc}
     */
    public function setFeltDatas($feltDatas)
    {
        $this->feltDatas = new ArrayCollection();

        foreach ($feltDatas as $feltData) {
            $this->addFeltData($feltData);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getFeltDatas()
    {
        return $this->feltDatas;
    }

    /**
     * {@inheritdoc}
     */
    public function addFeltData(FeltData $feltData)
    {
        $feltData->setOperator($this);
        $this->feltDatas[] = $feltData;
    }

    /**
     * {@inheritdoc}
     */
    public function setRiggDatas($riggDatas)
    {
        $this->riggDatas = new ArrayCollection();

        foreach ($riggDatas as $riggData) {
            $this->addRiggData($riggData);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getRiggDatas()
    {
        return $this->riggDatas;
    }

    /**
     * {@inheritdoc}
     */
    public function addRiggData(RiggData $riggData)
    {
        $riggData->setOperator($this);
        $this->riggDatas[] = $riggData;
    }
}
