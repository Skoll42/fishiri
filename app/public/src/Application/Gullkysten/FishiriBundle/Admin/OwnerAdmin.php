<?php

namespace Application\Gullkysten\FishiriBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Class OwnerAdmin
 * @package Application\Gullkysten\FishiriBundle\Admin
 */
class OwnerAdmin extends AbstractAdmin
{

    protected $baseRouteName = 'owner';
    protected $baseRoutePattern = 'owner';
    protected $searchResultActions = ['edit', 'show', 'list'];
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General', [
                'description' => 'This section contains general info about the Owner',
                'class' => 'col-xs-12',
                'box_class' => 'box box-primary box-solid',
            ])
            ->add('name', 'text', ['label' => 'Name'])
            ->end();
    }

    /**
     * @param ShowMapper $show
     */
    protected function configureShowFields(ShowMapper $show)
    {
        $show
            ->with('General', [
                'description' => 'This section contains general info about the Owner',
                'class' => 'col-xs-12',
                'box_class' => 'box box-primary box-solid',
            ])
            ->add('name', 'text', ['label' => 'Name'])
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

            ->add('_action', 'actions', [
                'actions' => [
                    'delete' => [],
                    'edit' => [],
                ]
            ])
        ;
    }
}
