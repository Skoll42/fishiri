<?php

namespace Application\Gullkysten\FishiriBundle\Admin\RiggData;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class DrillingEquipmentAdmin
 * @package Application\Gullkysten\FishiriBundle\Admin\RiggData
 */
class DrillingEquipmentAdmin extends AbstractAdmin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('derrickRating', 'text', [
                'label' => 'Derrick rating'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('derrickManufacturer', 'text', ['label' => 'Derrick manufacturer'])
            ->add('derrickFootprint', 'text', ['label' => 'Derrick footprint'])
            ->add('drawworksPower', 'text', [
                'label' => 'Drawworks power'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('drawworksManufacturer', 'text', ['label' => 'Drawworks manufacturer'])
            ->add('drillLineSize', 'text', [
                'label' => 'Drill line size'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*\.?[0-9]*',
                'fishiriFormat' => 'float number'
            ])
            ->add('rotaryTableSize', 'text', [
                'label' => 'Rotary table size'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*\.?[0-9]*',
                'fishiriFormat' => 'float number'
            ])
            ->add('ironRoughneck', 'text', ['label' => 'Iron roughneck'])
            ->add('topDrive', 'text', ['label' => 'Top drive'])
            ->add('heaveCompensatorManufacturer', 'text', ['label' => 'Heave compensator manufacturer'])
            ->add('heaveCompensatorCapacity', 'text', ['label' => 'Heave compensator capacity'])
            ->add('pipeRackingSystem', 'text', ['label' => 'Pipe racking system'])
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('derrickRating')
            ->add('derrickManufacturer')
            ->add('derrickFootprint')
            ->add('drawworksPower')
            ->add('drawworksManufacturer')
            ->add('drillLineSize')
            ->add('rotaryTableSize')
            ->add('ironRoughneck')
            ->add('topDrive')
            ->add('heaveCompensatorManufacturer')
            ->add('heaveCompensatorCapacity')
            ->add('pipeRackingSystem')

            ->add('_action', 'actions', [
                'actions' => [
                    'delete' => [],
                    'edit' => [],
                ]
            ])
        ;
    }
}
