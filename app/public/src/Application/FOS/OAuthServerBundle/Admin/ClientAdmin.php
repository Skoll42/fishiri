<?php

namespace Application\FOS\OAuthServerBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Class ClientAdmin
 * @package Application\FOS\OAuthServerBundle\Admin
 */
class ClientAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'client';
    protected $baseRoutePattern = 'client';
    protected $searchResultActions = ['edit', 'show', 'list'];

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->with('General', [
            'description' => 'This section contains general info about the api client',
            'box_class' => 'box box-primary box-solid',
            'class' => 'col-xs-12'
        ])
            ->add('name', 'text', ['label' => 'Client name'])
            ->add('clientId', 'text', [
                'label' => 'Client ID',
                'disabled'  => true
            ])
            ->add('secret', 'text', [
                'label' => 'Client secret',
                'disabled'  => true
            ])
            ->add('allowedGrantTypes', 'choice', [
            'choices' => [
                'client_credentials' => 'client_credentials',
                'password' => 'password',
                'refresh_token' => 'refresh_token'
            ],
            'data' => [
                'client_credentials' => 'client_credentials',
                'password' => 'password',
                'refresh_token' => 'refresh_token'
            ],
            'multiple' => true,
            'required' => true,
            'label' => 'Allowed grant types'
            ]);
    }

    /**
     * @param ShowMapper $show
     */
    protected function configureShowFields(ShowMapper $show)
    {
        $show->with('General', [
            'description' => 'This section contains general info about the api client',
            'box_class' => 'box box-primary box-solid',
            'class' => 'col-xs-12'
        ])
            ->add('name', 'text', ['label' => 'Client name'])
            ->add('clientId', 'text', [
                'label' => 'Client ID'
            ])
            ->add('secret', 'text', [
                'label' => 'Client secret'
            ])
            ->add('allowedGrantTypes', 'choice', [
                'choices' => [
                    'client_credentials' => 'client_credentials',
                    'password' => 'password',
                    'refresh_token' => 'refresh_token'
                ],
                'data' => [
                    'client_credentials' => 'client_credentials',
                    'password' => 'password',
                    'refresh_token' => 'refresh_token'
                ],
                'multiple' => true,
                'required' => true,
                'label' => 'Allowed grant types'
            ])
            ->end();
    }

    /**
     * @param DatagridMapper $datagrid
     */
    protected function configureDatagridFilters(DatagridMapper $datagrid)
    {
        $datagrid->add('name');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('clientId', 'text', ['label' => 'Client ID'])
            ->add('secret', 'text', ['label' => 'Client secret'])
            ->add('allowedGrantTypes', 'choice', [
                'multiple' => true,
                'delimiter' => ' | ',
                'label' => 'Allowed grant types',
                'choices' => [
                    'client_credentials' => 'client_credentials',
                    'password' => 'password',
                    'refresh_token' => 'refresh_token'
                ]
            ])

            ->add('_action', 'actions', [
                'actions' => [
                    'edit' => [],
                    'delete' => [],
                ]
            ]);
    }
}
