<?php

namespace Application\Gullkysten\FishiriBundle\EventListener;

use Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;
use Application\Gullkysten\FishiriBundle\Document\FeltData\FeltData;
use FOS\HttpCache\CacheInvalidator;
use FOS\HttpCache\ProxyClient\Varnish;
use Symfony\Component\Routing\Router;

/**
 * Class FeltDataListener
 * @package Application\Gullkysten\FishiriBundle\EventListener
 */
class FeltDataListener
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
        $feltData = $eventArgs->getDocument();
        if ($feltData instanceof FeltData) {
            /** @var $object FeltData */
            $this->invalidateCache($feltData);
        }
    }

    /**
     * @param LifecycleEventArgs $eventArgs
     */
    public function postRemove(LifecycleEventArgs $eventArgs)
    {
        $feltData = $eventArgs->getDocument();
        if ($feltData instanceof FeltData) {
            /** @var $object FeltData */
            $this->invalidateCache($feltData);
        }
    }

    /**
     * @param LifecycleEventArgs $eventArgs
     */
    public function postUpdate(LifecycleEventArgs $eventArgs)
    {
        $dm = $eventArgs->getDocumentManager();
        $feltData = $eventArgs->getDocument();
        if ($feltData instanceof FeltData) {
            /** @var $object FeltData */
            $dm->persist($feltData);
            $dm->flush($feltData);
            $this->invalidateCache($feltData);
        }
    }
    
    /**
     * @param $feltData
     */
    private function invalidateCache(FeltData $feltData)
    {
        $this->invalidator->invalidateRegex('\\' . $this->router->generate('get_feltdata'));
        $this->invalidator->invalidateRegex('\\' . $this->router->generate('get_feltdata_filters'));
        $this->invalidator->invalidateRegex('\\' . $this->router->generate('get_feltdata_names'));
        $this->invalidator->invalidateRegex('\\' . $this->router->generate('get_single_feltdata', ['feltName' => $feltData->getName()]));
        $this->invalidator->flush();
    }
}