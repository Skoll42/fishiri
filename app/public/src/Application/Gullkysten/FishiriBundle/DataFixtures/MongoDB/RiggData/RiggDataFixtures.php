<?php

namespace Application\Gullkysten\FishiriBundle\DataFixtures\MongoDB\RiggData;

use Application\Gullkysten\FishiriBundle\Document\RiggData\RiggData;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class RiggDataFixtures
 * @package Application\Gullkysten\FishiriBundle\DataFixtures\MongoDB\RiggData
 */
class RiggDataFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * @return array
     */
    public function load(ObjectManager $manager)
    {
        $createdIds = [];
        
        $riggData = new RiggData();
        $riggData->setRigId(118);
        $riggData->setName('Bollsta Dolphin');
        $riggData->setStatus('Under constr');
        $riggData->setOwner($manager->merge($this->getReference('owner_1')));
        $riggData->setOperator($manager->merge($this->getReference('operator_1')));
        $riggData->setType('jackup');
        $manager->persist($riggData);
        $this->addReference('riggData_1', $riggData);
        $createdIds[] = $riggData->getId();

        $riggData = new RiggData();
        $riggData->setRigId(13);
        $riggData->setName('Paragon C463');
        $riggData->setStatus('Aktiv');
        $riggData->setOwner($manager->merge($this->getReference('owner_2')));
        $riggData->setOperator($manager->merge($this->getReference('operator_2')));
        $riggData->setType('semisubmersible');
        $manager->persist($riggData);
        $this->addReference('riggData_2', $riggData);
        $createdIds[] = $riggData->getId();

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
