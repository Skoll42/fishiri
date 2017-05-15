<?php

namespace Application\Gullkysten\FishiriBundle\DataFixtures\MongoDB;

use Application\Gullkysten\FishiriBundle\Document\Owner;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class OwnerFixtures
 * @package Application\Gullkysten\FishiriBundle\DataFixtures\MongoDB
 */
class OwnerFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * @return array
     */
    public function load(ObjectManager $manager)
    {
        $createdIds = [];

        $owner = new Owner();
        $owner->setName('Maersk Supply');
        $manager->persist($owner);
        $this->addReference('owner_1', $owner);
        $createdIds[] = $owner->getId();

        $owner = new Owner();
        $owner->setName('Nor Supply');
        $manager->persist($owner);
        $this->addReference('owner_2', $owner);
        $createdIds[] = $owner->getId();

        $manager->flush();

        return $createdIds;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }
}
