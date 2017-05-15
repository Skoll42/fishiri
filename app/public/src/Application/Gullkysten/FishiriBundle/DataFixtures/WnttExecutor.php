<?php
namespace Application\Gullkysten\FishiriBundle\DataFixtures;

use Doctrine\Common\DataFixtures\Executor\MongoDBExecutor;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\SharedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class WnttExecutor
 * @package Application\Gullkysten\FishiriBundle\DataFixtures
 */
class WnttExecutor extends MongoDBExecutor
{
    protected $createdObjects = [];

    /** @inheritDoc */
    public function execute(array $fixtures, $append = false)
    {
        if ($append === false) {
            $this->purge();
        }
        foreach ($fixtures as $fixture) {
            $createdIds = $this->load($this->dm, $fixture);
            if (!empty($createdIds)) {
                $this->collectCreatedIds($fixture, $createdIds);
            }
        }
    }

    /**
     * Load a fixture with the given persistence manager.
     *
     * @param ObjectManager $manager
     * @param FixtureInterface $fixture
     *
     * @return array
     */
    public function load(ObjectManager $manager, FixtureInterface $fixture)
    {
        if ($this->logger) {
            $prefix = '';
            if ($fixture instanceof OrderedFixtureInterface) {
                $prefix = sprintf('[%d] ', $fixture->getOrder());
            }
            $this->log('loading ' . $prefix . get_class($fixture));
        }
        // additionally pass the instance of reference repository to shared fixtures
        if ($fixture instanceof SharedFixtureInterface) {
            $fixture->setReferenceRepository($this->referenceRepository);
        }
        $createdIds = $fixture->load($manager);
        $manager->clear();

        return $createdIds;
    }

    /**
     * @return array
     */
    public function getCreatedObjects()
    {
        return $this->createdObjects;
    }

    /**
     * @param FixtureInterface $fixture
     * @param $createdIds
     */
    protected function collectCreatedIds(FixtureInterface $fixture, $createdIds)
    {
        $fixtureClass = explode('\\', get_class($fixture));
        $fixtureClassName = end($fixtureClass);
        if (!isset($this->createdObjects[$fixtureClassName])) {
            $this->createdObjects[$fixtureClassName] = [];
        }
        $this->createdObjects[$fixtureClassName] = $createdIds;
    }
}
