<?php

namespace Application\Gullkysten\FishiriBundle\Admin\RiggData;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class LiftingEquipmentAdmin
 * @package Application\Gullkysten\FishiriBundle\Admin\RiggData
 */
class LiftingEquipmentAdmin extends AbstractAdmin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('pedestalCrane1', 'text', [
                'label' => 'Pedestal crane 1'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*\.?[0-9]*',
                'fishiriFormat' => 'float number'
            ])
            ->add('pedestalCrane2', 'text', [
                'label' => 'Pedestal crane 2'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*\.?[0-9]*',
                'fishiriFormat' => 'float number'
            ])
            ->add('pedestalCrane3', 'text', [
                'label' => 'Pedestal crane 3'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*\.?[0-9]*',
                'fishiriFormat' => 'float number'
            ])
            ->add('pedestalCrane4', 'text', [
                'label' => 'Pedestal crane 4'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*\.?[0-9]*',
                'fishiriFormat' => 'float number'
            ])
            ->add('riserHandlingCrane', 'text', [
                'label' => 'Riser handling crane'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*\.?[0-9]*',
                'fishiriFormat' => 'float number'
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
            ->add('pedestalCrane1')
            ->add('pedestalCrane2')
            ->add('pedestalCrane3')
            ->add('pedestalCrane4')
            ->add('riserHandlingCrane')

            ->add('_action', 'actions', [
                'actions' => [
                    'delete' => [],
                    'edit' => [],
                ]
            ])
        ;
    }
}
