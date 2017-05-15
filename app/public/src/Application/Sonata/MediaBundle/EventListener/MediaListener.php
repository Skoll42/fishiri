<?php

namespace Application\Sonata\MediaBundle\EventListener;
use Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;
use Application\Sonata\MediaBundle\Document\Media;
use Sonata\MediaBundle\Provider\MediaProviderInterface;

class MediaListener
{
    private $provider;

    public function __construct(MediaProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @param LifecycleEventArgs $eventArgs
     */
    public function postPersist(LifecycleEventArgs $eventArgs)
    {
        $dm = $eventArgs->getDocumentManager();
        $media = $eventArgs->getDocument();
        if ($media instanceof Media) {
            /** @var $object Media */
            $media->setS3Url($this->provider->generatePublicUrl($media, 'reference'));
            $dm->persist($media);
            $dm->flush($media);
        }
    }

    /**
     * @param LifecycleEventArgs $eventArgs
     */
    public function postUpdate(LifecycleEventArgs $eventArgs)
    {
        $dm = $eventArgs->getDocumentManager();
        $media = $eventArgs->getDocument();
        if ($media instanceof Media) {
            $media->setS3Url($this->provider->generatePublicUrl($media, 'reference'));
            /** @var $object Media */
            $dm->persist($media);
            $dm->flush($media);
        }
    }
}