<?php

namespace Application\Gullkysten\FishiriBundle\DataFixtures\MongoDB\DockedShips;

use Application\Gullkysten\FishiriBundle\Document\DockedShips\DockedShips;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class DockedShipsFixtures
 * @package Application\Gullkysten\FishiriBundle\DataFixtures\MongoDB\DockedShips
 */
class DockedShipsFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * @return array
     */
    public function load(ObjectManager $manager)
    {
        $createdIds = [];

        $dockedShipsItem = new DockedShips();
        $dockedShipsItem->setName('Maersk Shipper');
        $dockedShipsItem->setDateIn(new \DateTime('2015-04-02'));
        $dockedShipsItem->setOwner($manager->merge($this->getReference('owner_1')));
        $manager->persist($dockedShipsItem);
        $this->addReference('dockedShips_1', $dockedShipsItem);
        $createdIds[] = $dockedShipsItem->getId();

        $dockedShipsItem = new DockedShips();
        $dockedShipsItem->setName('Sea Trout');
        $dockedShipsItem->setDateIn(new \DateTime('2015-07-09'));
        $dockedShipsItem->setOwner($manager->merge($this->getReference('owner_2')));
        $manager->persist($dockedShipsItem);
        $this->addReference('dockedShips_2', $dockedShipsItem);
        $createdIds[] = $dockedShipsItem->getId();

        $dockedShipsItem = new DockedShips();
        $dockedShipsItem->setName('Island Duke');
        $dockedShipsItem->setDateIn(new \DateTime('2015-07-01'));
        $dockedShipsItem->setOwner($manager->merge($this->getReference('owner_1')));
        $manager->persist($dockedShipsItem);
        $this->addReference('dockedShips_3', $dockedShipsItem);
        $createdIds[] = $dockedShipsItem->getId();

        $manager->flush();

        return $createdIds;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 2;
    }
}
