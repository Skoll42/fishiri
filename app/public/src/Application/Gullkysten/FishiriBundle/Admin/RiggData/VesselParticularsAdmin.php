<?php

namespace Application\Gullkysten\FishiriBundle\Admin\RiggData;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class VesselParticularsAdmin
 * @package Application\Gullkysten\FishiriBundle\Admin\RiggData
 */
class VesselParticularsAdmin extends AbstractAdmin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('totalVesselPower', 'text', [
                'label' => 'Total vessel power'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('maximumVesselSpeed', 'text', ['label' => 'Maximum vessel speed'])
            ->add('quartersCapacity', 'text', [
                'label' => 'Quarters capacity'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('length', 'text', [
                'label' => 'Length'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('width', 'text', [
                'label' => 'Width'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('transitDraft', 'text', [
                'label' => 'Transit draft'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*\.?[0-9]*',
                'fishiriFormat' => 'float number'
            ])
            ->add('operationDraft', 'text', [
                'label' => 'Operation draft'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*\.?[0-9]*',
                'fishiriFormat' => 'float number'
            ])
            ->add('maximumVariableLoad', 'text', ['label' => 'Maximum variable load'])
            ->add('moonpoolSize', 'text', ['label' => 'Moonpool size'])
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('totalVesselPower')
            ->add('maximumVesselSpeed')
            ->add('quartersCapacity')
            ->add('length')
            ->add('width')
            ->add('transitDraft')
            ->add('operationDraft')
            ->add('maximumVariableLoad')
            ->add('moonpoolSize')

            ->add('_action', 'actions', [
                'actions' => [
                    'delete' => [],
                    'edit' => [],
                ]
            ])
        ;
    }
}
