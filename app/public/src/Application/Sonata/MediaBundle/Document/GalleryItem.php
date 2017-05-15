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

use Sonata\MediaBundle\Document\BaseGalleryItem as BaseGalleryItem;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Sonata\MediaBundle\Model\MediaInterface;

/**
 * @MongoDB\Document(collection="gallery_item")
 */
class GalleryItem extends BaseGalleryItem
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\ReferenceOne(
     *     targetDocument="Application\Sonata\MediaBundle\Document\Gallery",
     *     mappedBy="galleryItems",
     *     cascade={"persist"},
     *     nullable="true"
     * )
     */
    protected $gallery;

    /**
     * @MongoDB\ReferenceOne(
     *     targetDocument="Application\Sonata\MediaBundle\Document\Media",
     *     mappedBy="galleryItems",
     *     cascade={"persist"},
     *     nullable="true"
     * )
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
}
