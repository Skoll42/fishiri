<?php

namespace Application\Gullkysten\FishiriBundle\DataFixtures\MongoDB\FeltData;

use Application\Gullkysten\FishiriBundle\Document\FeltData\FeltData;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class FeltDataFixtures
 * @package Application\Gullkysten\FishiriBundle\DataFixtures\MongoDB\FeltData
 */
class FeltDataFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * @return array
     */
    public function load(ObjectManager $manager)
    {
        $createdIds = [];

        $feltData = new FeltData();
        $feltData->setName('ORMEN LANGE');
        $feltData->setOperator($manager->merge($this->getReference('operator_1')));
        $feltData->setStatus('PRODUCING');
        $feltData->setLocation('NS(S)');
        $feltData->setDescription(
            'Morvin ligger omtrent 20 km nord for Kristinfeltet og 15 km vest for Åsgardfeltet.
             Feltet er bygget ut med to havbunnrammer knyttet til Åsgard B.'
        );
        $feltData->setDiscoveryYear(2008);
        $feltData->setOnStream(2010);
        $feltData->setProductionLicense('18');
        $feltData->setWaterDepth(45);
        $feltData->setSupplyBase('Vestbase AS(Kristiansund)');
        $manager->persist($feltData);
        $this->addReference('feltData_1', $feltData);
        $createdIds[] = $feltData->getId();

        $feltData = new FeltData();
        $feltData->setName('OSEBERG SØR');
        $feltData->setOperator($manager->merge($this->getReference('operator_2')));
        $feltData->setStatus('SHUT DOWN');
        $feltData->setLocation('BS');
        $feltData->setDescription(
            'Njord er et oljefelt som ligger i Norskehavet omtrent 30 kilo­meter vest for Draugen. '
        );
        $feltData->setDiscoveryYear(1978);
        $feltData->setOnStream(1992);
        $feltData->setProductionLicense('18');
        $feltData->setWaterDepth(110);
        $feltData->setSupplyBase('Dusavik');
        $manager->persist($feltData);
        $this->addReference('feltData_2', $feltData);
        $createdIds[] = $feltData->getId();

        $feltData = new FeltData();
        $feltData->setName('STATFJORD');
        $feltData->setOperator($manager->merge($this->getReference('operator_1')));
        $feltData->setStatus('PRODUCING');
        $feltData->setLocation('NS(M)');
        $feltData->setDescription(
            'Oseberg er et oljefelt med en overliggende gasskappe i den nordlege delen av Nordsjøen.
             Oseberg er bygget ut i flere faser. '
        );
        $feltData->setDiscoveryYear(1994);
        $feltData->setOnStream(2011);
        $feltData->setProductionLicense('FRIGG UNIT');
        $feltData->setWaterDepth(132);
        $feltData->setSupplyBase('Dusavik');
        $manager->persist($feltData);
        $this->addReference('feltData_3', $feltData);
        $createdIds[] = $feltData->getId();

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
