<?php

namespace Application\Sonata\UserBundle\Admin;

use Application\Sonata\UserBundle\Document\User;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Class UserAdmin
 * @package Application\Sonata\UserBundle\Admin
 */
class UserAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'user';
    protected $baseRoutePattern = 'user';
    protected $searchResultActions = ['edit', 'show', 'list'];

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Profile')
            ->with('General', [
                'description' => 'This section contains general info about the user',
                'class' => 'col-xs-12',
                'box_class' => 'box box-primary box-solid',
            ])
            ->add('username', 'text', ['label' => 'Username'])
            ->add('email', 'text', ['label' => 'Email'])
            ->add('fullName', 'text', [
                'label' => 'Full name',
                'required' => false
            ])
            ->end()
            ->end();


        $formMapper->tab('Security')
            ->with('Password', [
                'description' => 'This section allows to change the password',
                'class' => 'col-xs-12 col-md-8',
                'box_class' => 'box box-primary box-solid',
            ])
            ->add('plainPassword', 'password', ['label' => 'Password'])
            ->end();

        $formMapper
            ->with('Roles', [
                'description' => 'This section contains info about what role this user has',
                'class' => 'col-xs-12 col-md-4',
                'box_class' => 'box box-primary box-solid',
            ])
            ->add('roles', 'choice', [
                'choices' => [
                    User::ROLE_DEFAULT => 'User',
                    User::ROLE_ADMIN => 'Admin',
                    User::ROLE_ADMIN_DOCKEDSHIPS => 'Admin DockedShips',
                    User::ROLE_ADMIN_FELTDATA => 'Admin FeltData',
                    User::ROLE_ADMIN_RIGGDATA => 'Admin RiggData',
                    User::ROLE_SUPER_ADMIN => 'Super Admin'
                ],
                'multiple' => true,
                'required' => true
            ])
            ->end()
            ->end();
    }

    /**
     * @param ShowMapper $show
     */
    protected function configureShowFields(ShowMapper $show)
    {
        $show
            ->tab('Profile')
            ->with('General', [
                'description' => 'This section contains general info about the user',
                'class' => 'col-xs-12 col-md-8',
                'box_class' => 'box box-primary box-solid',
            ])
            ->add('username', 'text', ['label' => 'Username'])
            ->add('email', 'text', ['label' => 'Email'])
            ->add('fullName', 'text', [
                'label' => 'Full name',
                'required' => false
            ])
            ->end()
            ->end();


        $show->tab('Security')
            ->with('Password', [
                'description' => 'This section allows to change the password',
                'class' => 'col-xs-12 col-md-8',
                'box_class' => 'box box-primary box-solid',
            ])
            ->add('plainPassword', 'password', ['label' => 'Password'])
            ->end();

        $show
            ->with('Roles', [
                'description' => 'This section contains info about what role this user has',
                'class' => 'col-xs-12 col-md-4',
                'box_class' => 'box box-primary box-solid',
            ])
            ->add('roles', 'choice', [
                'choices' => [
                    User::ROLE_DEFAULT => 'User',
                    User::ROLE_ADMIN => 'Admin',
                    User::ROLE_ADMIN_DOCKEDSHIPS => 'Admin DockedShips',
                    User::ROLE_ADMIN_FELTDATA => 'Admin FeltData',
                    User::ROLE_ADMIN_RIGGDATA => 'Admin RiggData',
                    User::ROLE_SUPER_ADMIN => 'Super Admin'
                ],
                'multiple' => true,
                'required' => true
            ])
            ->end()
            ->end();
    }

    /**
     * @param DatagridMapper $datagrid
     */
    protected function configureDatagridFilters(DatagridMapper $datagrid)
    {
        $datagrid
            ->add('username')
            ->add('email')
            ->add('fullName');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('username')
            ->add('email')
            ->add('fullName')
            ->add('roles', 'choice', [
                'multiple' => true,
                'delimiter' => ' | ',
                'choices' => [
                    User::ROLE_DEFAULT => 'User',
                    User::ROLE_ADMIN => 'Admin',
                    User::ROLE_ADMIN_DOCKEDSHIPS => 'Admin DockedShips',
                    User::ROLE_ADMIN_FELTDATA => 'Admin FeltData',
                    User::ROLE_ADMIN_RIGGDATA => 'Admin RiggData',
                    User::ROLE_SUPER_ADMIN => 'Super Admin'
                ]
            ]);
    }
}
