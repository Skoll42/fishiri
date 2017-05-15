<?php

namespace Application\Gullkysten\FishiriBundle\EventListener;

use Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;
use Application\Gullkysten\FishiriBundle\Document\DockedShips\DockedShips;
use FOS\HttpCache\CacheInvalidator;
use FOS\HttpCache\ProxyClient\Varnish;
use Symfony\Component\Routing\Router;

/**
 * Class DockedShipsListener
 * @package Application\Gullkysten\FishiriBundle\EventListener
 */
class DockedShipsListener
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
    public function preUpdate(LifecycleEventArgs $eventArgs)
    {
        $dm = $eventArgs->getDocumentManager();
        $dockedShip = $eventArgs->getDocument();
        if ($dockedShip instanceof DockedShips) {
            /** @var $object DockedShips */
            $dockedShip->setStatus($dockedShip->getStatus());
            $dm->persist($dockedShip);
        }
    }

    /**
     * @param LifecycleEventArgs $eventArgs
     */
    public function prePersist(LifecycleEventArgs $eventArgs)
    {
        $dm = $eventArgs->getDocumentManager();
        $dockedShip = $eventArgs->getDocument();
        if ($dockedShip instanceof DockedShips) {
            /** @var $object DockedShips */
            $dockedShip->setStatus($dockedShip->getStatus());
            $dm->persist($dockedShip);
        }
    }

    /**
     * @param LifecycleEventArgs $eventArgs
     */
    public function postPersist(LifecycleEventArgs $eventArgs)
    {
        $dockedShip = $eventArgs->getDocument();
        if ($dockedShip instanceof DockedShips) {
            /** @var $object DockedShips */
            $this->invalidateCache($dockedShip);
        }
    }

    /**
     * @param LifecycleEventArgs $eventArgs
     */
    public function postRemove(LifecycleEventArgs $eventArgs)
    {
        $dockedShip = $eventArgs->getDocument();
        if ($dockedShip instanceof DockedShips) {
            /** @var $object DockedShips */
            $this->invalidateCache($dockedShip);
        }
    }

    /**
     * @param LifecycleEventArgs $eventArgs
     */
    public function postUpdate(LifecycleEventArgs $eventArgs)
    {
        $dm = $eventArgs->getDocumentManager();
        $dockedShip = $eventArgs->getDocument();
        if ($dockedShip instanceof DockedShips) {
            /** @var $object DockedShips */
            $dm->persist($dockedShip);
            $dm->flush($dockedShip);
            $this->invalidateCache($dockedShip);
        }
    }

    /**
     * @param $dockedShip
     */
    private function invalidateCache(DockedShips $dockedShip)
    {
        $this->invalidator->invalidateRegex('\\' . $this->router->generate('get_dockedships'));
        $this->invalidator->invalidateRegex('\\' . $this->router->generate('get_dockedships_filters'));
        $this->invalidator->invalidateRegex('\\' . $this->router->generate('get_dockedships_names'));
        $this->invalidator->invalidateRegex('\\' . $this->router->generate('get_dockedships_widget'));
        $this->invalidator->invalidateRegex('\\' . $this->router->generate('get_dockedship', ['id' => $dockedShip->getId()]));
        $this->invalidator->flush();
    }
}