<?php

namespace Application\Gullkysten\FishiriBundle\Admin\FeltData;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class DrillingWellsAdmin
 * @package Application\Gullkysten\FishiriBundle\Admin\FeltData
 */
class DrillingWellsAdmin extends AbstractAdmin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('exploration', 'text', [
                'label' => 'Exploration'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('development', 'text', [
                'label' => 'Development'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('topReservoirDepth', 'text', [
                'label' => 'Top reservoir depth'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('exploration')
            ->add('development')
            ->add('topReservoirDepth')

            ->add('_action', 'actions', [
                'actions' => [
                    'delete' => [],
                    'edit' => [],
                ]
            ])
        ;
    }
}
