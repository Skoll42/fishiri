<?php

namespace Application\Gullkysten\FishiriBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Class OperatorAdmin
 * @package Application\Gullkysten\FishiriBundle\Admin
 */
class OperatorAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'operator';
    protected $baseRoutePattern = 'operator';
    protected $searchResultActions = ['edit', 'show', 'list'];
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General', [
                'description' => 'This section contains general info about the Operator',
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
                'description' => 'This section contains general info about the Operator',
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
