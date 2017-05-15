<?php

/**
 * This file is part of the <name> project.
 *
 * (c) <yourname> <youremail>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\MediaBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Sonata\MediaBundle\Document\BaseMedia as BaseMedia;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Sonata\MediaBundle\Model\GalleryInterface;
use Sonata\MediaBundle\Model\GalleryItemInterface;
use Sonata\MediaBundle\Model\MediaInterface;

/**
 * @MongoDB\Document(collection="media")
 */
class Media extends BaseMedia
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @MongoDB\ReferenceOne(
     *     targetDocument="Application\Gullkysten\FishiriBundle\Document\DockedShips\DockedShips",
     *     inversedBy="media",
     *     nullable="true"
     * )
     */
    protected $dockedShip;

    /**
     * @MongoDB\ReferenceMany(
     *     targetDocument="Application\Sonata\MediaBundle\Document\GalleryItem",
     *     inversedBy="gallery",
     *     cascade={"persist"},
     *     nullable="true"
     * )
     */
    protected $galleryItems = [];

    /**
     * @MongoDB\String
     */
    protected $s3Url;

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * {@inheritdoc}
     */
    public function setGalleryItems($galleryItems)
    {
        $this->galleryItems = new ArrayCollection();

        foreach ($galleryItems as $galleryItem) {
            $this->addGalleryItem($galleryItem);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getGalleryItems()
    {
        return $this->galleryItems;
    }

    /**
     * {@inheritdoc}
     */
    public function addGalleryItem(GalleryItemInterface $galleryItem)
    {
        $galleryItem->setMedia($this);
        $this->galleryItems[] = $galleryItem;
    }

    /**
     * @return string
     */
    public function getS3Url()
    {
        return $this->s3Url;
    }

    /**
     * @param string $s3Url
     */
    public function setS3Url($s3Url)
    {
        $this->s3Url = $s3Url;
    }
}