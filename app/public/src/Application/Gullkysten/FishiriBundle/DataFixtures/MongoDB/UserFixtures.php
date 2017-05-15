<?php

namespace Application\Gullkysten\FishiriBundle\DataFixtures\MongoDB;

use Application\Sonata\UserBundle\Document\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class UserFixtures
 * @package Application\Gullkysten\FishiriBundle\DataFixtures\MongoDB
 */
class UserFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param ObjectManager $manager
     * @return array
     */
    public function load(ObjectManager $manager)
    {
        $createdIds = [];

        /** @var $userManager \FOS\UserBundle\Doctrine\UserManager */
        $userManager = $this->container->get('fos_user.user_manager');

        $user = $userManager->createUser();
        $user->setUsername('tinyadmin');
        $user->setEmail('tiny@admin.fishiri');
        $user->setPlainPassword('tinyadmin');
        $user->setEnabled(true);
        $user->setRoles([
            User::ROLE_DEFAULT,
            User::ROLE_ADMIN
        ]);
        $manager->persist($user);
        $this->addReference('user_tinyadmin', $user);
        $createdIds[] = $user->getId();

        $user = $userManager->createUser();
        $user->setUsername('dockedships');
        $user->setEmail('dockedships@admin.fishiri');
        $user->setPlainPassword('dockedships');
        $user->setEnabled(true);
        $user->setRoles([
            User::ROLE_DEFAULT,
            User::ROLE_ADMIN,
            User::ROLE_ADMIN_DOCKEDSHIPS
        ]);
        $manager->persist($user);
        $this->addReference('user_dockedships', $user);
        $createdIds[] = $user->getId();

        $user = $userManager->createUser();
        $user->setUsername('feltdata');
        $user->setEmail('feltdata@admin.fishiri');
        $user->setPlainPassword('feltdata');
        $user->setEnabled(true);
        $user->setRoles([
            User::ROLE_DEFAULT,
            User::ROLE_ADMIN,
            User::ROLE_ADMIN_FELTDATA
        ]);
        $manager->persist($user);
        $this->addReference('user_feltdata', $user);
        $createdIds[] = $user->getId();

        $user = $userManager->createUser();
        $user->setUsername('riggdata');
        $user->setEmail('riggdata@admin.fishiri');
        $user->setPlainPassword('riggdata');
        $user->setEnabled(true);
        $user->setRoles([
            User::ROLE_DEFAULT,
            User::ROLE_ADMIN,
            User::ROLE_ADMIN_RIGGDATA
        ]);
        $manager->persist($user);
        $this->addReference('user_riggdata', $user);
        $createdIds[] = $user->getId();

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
