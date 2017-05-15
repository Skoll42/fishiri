<?php

namespace Application\Gullkysten\FishiriBundle\DataFixtures\MongoDB;

use Application\Gullkysten\FishiriBundle\Document\Operator;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class OperatorFixtures
 * @package Application\Gullkysten\FishiriBundle\DataFixtures\MongoDB
 */
class OperatorFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * @return array
     */
    public function load(ObjectManager $manager)
    {
        $createdIds = [];

        $operator = new Operator();
        $operator->setName('Statoil');
        $manager->persist($operator);
        $this->addReference('operator_1', $operator);
        $createdIds[] = $operator->getId();

        $operator = new Operator();
        $operator->setName('BP');
        $manager->persist($operator);
        $this->addReference('operator_2', $operator);
        $createdIds[] = $operator->getId();

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
