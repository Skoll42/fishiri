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

use Application\Gullkysten\FishiriBundle\Document\FeltData\FeltData;
use Application\Gullkysten\FishiriBundle\Document\RiggData\RiggData;
use Doctrine\Common\Collections\ArrayCollection;
use Sonata\MediaBundle\Document\BaseGallery as BaseGallery;
use Sonata\MediaBundle\Model\GalleryItemInterface;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="gallery")
 */
class Gallery extends BaseGallery
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\ReferenceMany(
     *     strategy="atomicSetArray",
     *     targetDocument="Application\Sonata\MediaBundle\Document\GalleryItem",
     *     inversedBy="gallery",
     *     cascade={"persist"},
     *     nullable="true"
     * )
     */
    protected $galleryItems = [];

    /**
     * @MongoDB\ReferenceMany(
     *     strategy="atomicSetArray",
     *     targetDocument="Application\Gullkysten\FishiriBundle\Document\RiggData\RiggData",
     *     mappedBy="gallery",
     *     nullable="true"
     * )
     */
    protected $riggDatas = [];

    /**
     * @MongoDB\ReferenceMany(
     *     strategy="atomicSetArray",
     *     targetDocument="Application\Gullkysten\FishiriBundle\Document\FeltData\FeltData",
     *     mappedBy="gallery",
     *     nullable="true"
     * )
     */
    protected $feltDatas = [];

    /**
     * Gallery constructor.
     */
    public function __construct()
    {
    }

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
        $feltData->setGallery($this);
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
        $riggData->setGallery($this);
        $this->riggDatas[] = $riggData;
    }
}