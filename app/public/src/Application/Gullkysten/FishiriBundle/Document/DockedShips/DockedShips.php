<?php

namespace Application\Gullkysten\FishiriBundle\Document\DockedShips;

use Application\Gullkysten\FishiriBundle\Document\DocumentInterface;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Oh\GoogleMapFormTypeBundle\Validator\Constraints as OhAssert;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\SoftDeleteable;
use JMS\Serializer\Annotation as Serializer;

/**
 * @MongoDB\Document(
 *     collection="dockedships",
 *     repositoryClass="Application\Gullkysten\FishiriBundle\Repository\DockedShipsRepository"
 * )
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @Gedmo\Loggable
 */
class DockedShips implements DocumentInterface, SoftDeleteable
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\String
     * @Assert\NotBlank()
     * @Gedmo\Versioned
     */
    protected $name;

    /**
     * @MongoDB\Date
     * @Gedmo\Versioned
     */
    protected $dateIn;

    /**
     * @MongoDB\Date
     * @Gedmo\Versioned
     */
    protected $dateOut;

    /**
     * @MongoDB\String
     * @Assert\NotBlank()
     * @Gedmo\Versioned
     */
    protected $status;

    /**
     * @MongoDB\ReferenceOne(
     *     targetDocument="Application\Gullkysten\FishiriBundle\Document\Owner",
     *     inversedBy="dockedShips",
     *     cascade={"persist"},
     *     nullable="true"
     * )
     */
    protected $owner;

    /**
     * @MongoDB\String
     * @Assert\NotBlank()
     * @Gedmo\Versioned
     */
    protected $typeSkip;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $flagg;

    /**
     * @MongoDB\Float
     * @Gedmo\Versioned
     */
    protected $latitude;

    /**
     * @MongoDB\Float
     * @Gedmo\Versioned
     */
    protected $longitude;

    /**
     * @MongoDB\String
     * @Gedmo\Versioned
     */
    protected $locationName;

    /**
     * @MongoDB\Date
     */
    protected $deletedAt;

    /**
     * @MongoDB\Date
     * @Gedmo\Timestampable(on="update")
     * @Assert\NotBlank()
     */
    protected $lastEdited;

    /**
     * @MongoDB\ReferenceOne(
     *     targetDocument="Application\Sonata\MediaBundle\Document\Media",
     *     cascade={"persist"},
     *     nullable="true"
     * )
     * @Serializer\Expose
     */
    protected $media;

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
     * @return \DateTime
     */
    public function getDateIn()
    {
        return $this->dateIn;
    }

    /**
     * @param \DateTime $dateIn
     */
    public function setDateIn($dateIn)
    {
        $this->dateIn = $dateIn;
    }

    /**
     * @return \DateTime
     */
    public function getDateOut()
    {
        return $this->dateOut;
    }

    /**
     * @param \DateTime $dateOut
     */
    public function setDateOut($dateOut)
    {
        $this->dateOut = $dateOut;
    }

    /**
     * @return \Application\Gullkysten\FishiriBundle\Document\Owner
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param \Application\Gullkysten\FishiriBundle\Document\Owner $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return string
     */
    public function getTypeSkip()
    {
        return $this->typeSkip;
    }

    /**
     * @param string $typeSkip
     */
    public function setTypeSkip($typeSkip)
    {
        $this->typeSkip = $typeSkip;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return string
     */
    public function getLocationName()
    {
        return $this->locationName;
    }

    /**
     * @param string $locationName
     */
    public function setLocationName($locationName)
    {
        $this->locationName = $locationName;
    }

    /**
     * @param $latlng
     * @return $this
     */
    public function setLatLng($latlng)
    {
        $this->setLatitude($latlng['lat']);
        $this->setLongitude($latlng['lng']);
        return $this;
    }

    /**
     * @return array/
     * @Assert\NotBlank()
     * @OhAssert\LatLng()
     */
    public function getLatLng()
    {
        return ['lat'=>$this->getLatitude(),'lng'=>$this->getLongitude()];
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
     * @param MediaInterface|null $media
     */
    public function setMedia(MediaInterface $media = null)
    {
        $this->media = $media;
    }

    /**
     * @return mixed
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @return mixed
     */
    public function getFlagg()
    {
        return $this->flagg;
    }

    /**
     * @param mixed $flagg
     */
    public function setFlagg($flagg)
    {
        $this->flagg = $flagg;
    }

    /**
     * @return \DateTime
     */
    public function getLastEdited()
    {
        return $this->lastEdited;
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
}
