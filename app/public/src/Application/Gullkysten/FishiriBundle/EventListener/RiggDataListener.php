<?php

namespace Application\Gullkysten\FishiriBundle\EventListener;

use Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;
use Application\Gullkysten\FishiriBundle\Document\RiggData\RiggData;
use FOS\HttpCache\CacheInvalidator;
use FOS\HttpCache\ProxyClient\Varnish;
use Symfony\Component\Routing\Router;

/**
 * Class RiggDataListener
 * @package Application\Gullkysten\FishiriBundle\EventListener
 */
class RiggDataListener
{
    private $invalidator;
    private $router;

    /**
     * @param Varnish $varnish
     * @param Router $router
     */
    public function __construct(Varnish $varnish, Router $router)
    {
        $this->invalidator = new CacheInvalidator($varnish);
        $this->router = $router;
    }

    /**
     * @param LifecycleEventArgs $eventArgs
     */
    public function postPersist(LifecycleEventArgs $eventArgs)
    {
        $riggData = $eventArgs->getDocument();
        if ($riggData instanceof RiggData) {
            /** @var $object RiggData */
            $this->invalidateCache($riggData);
        }
    }

    /**
     * @param LifecycleEventArgs $eventArgs
     */
    public function postRemove(LifecycleEventArgs $eventArgs)
    {
        $riggData = $eventArgs->getDocument();
        if ($riggData instanceof RiggData) {
            /** @var $object RiggData */
            $this->invalidateCache($riggData);
        }
    }

    /**
     * @param LifecycleEventArgs $eventArgs
     */
    public function postUpdate(LifecycleEventArgs $eventArgs)
    {
        $dm = $eventArgs->getDocumentManager();
        $riggData = $eventArgs->getDocument();
        if ($riggData instanceof RiggData) {
            /** @var $object RiggData */
            $dm->persist($riggData);
            $dm->flush($riggData);
            $this->invalidateCache($riggData);
        }
    }

    /**
     * @param $riggData
     */
    private function invalidateCache(RiggData $riggData)
    {
        $this->invalidator->invalidateRegex('\\' . $this->router->generate('get_riggdata'));
        $this->invalidator->invalidateRegex('\\' . $this->router->generate('get_riggdata_filters'));
        $this->invalidator->invalidateRegex('\\' . $this->router->generate('get_riggdata_names'));
        $this->invalidator->invalidateRegex('\\' . $this->router->generate('get_single_riggdata', ['rigId' => $riggData->getRigId()]));
        $this->invalidator->flush();
    }
}