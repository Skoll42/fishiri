<?php

namespace Application\Gullkysten\FishiriBundle\Admin\RiggData;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class MudSystemsAdmin
 * @package Application\Gullkysten\FishiriBundle\Admin\RiggData
 */
class MudSystemsAdmin extends AbstractAdmin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('mudPumpsNumber', 'text', [
                'label' => 'Mud pumps number'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('mudPumpsManufacturerAndModel', 'text', ['label' => 'Mud pumps manufacturer and model'])
            ->add('liquidMud', 'text', [
                'label' => 'Liquid mud'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*\.?[0-9]*',
                'fishiriFormat' => 'float number'
            ])
            ->add('fuelOil', 'text', [
                'label' => 'Fuel oil'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*\.?[0-9]*',
                'fishiriFormat' => 'float number'
            ])
            ->add('bulkStorageCapacity', 'text', ['label' => 'Bulk storage capacity'])
            ->add('shaleShakers', 'text', [
                'label' => 'Shale shakers'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('desander', 'text', [
                'label' => 'Desander'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('desilter', 'text', [
                'label' => 'Desilter'
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
            ->add('mudPumpsNumber')
            ->add('mudPumpsManufacturerAndModel')
            ->add('liquidMud')
            ->add('fuelOil')
            ->add('bulkStorageCapacity')
            ->add('shaleShakers')
            ->add('desander')
            ->add('desilter')

            ->add('_action', 'actions', [
                'actions' => [
                    'delete' => [],
                    'edit' => [],
                ]
            ])
        ;
    }
}
