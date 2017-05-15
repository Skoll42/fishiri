<?php

namespace Application\Gullkysten\FishiriBundle\Admin\RiggData;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class BopAndBopControlDataAdmin
 * @package Application\Gullkysten\FishiriBundle\Admin\RiggData
 */
class BopAndBopControlDataAdmin extends AbstractAdmin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('bopOperatingPressure', 'text', [
                'label' => 'Bop operating pressure'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('ckLineSize', 'text', [
                'label' => 'CK line size'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*\.?[0-9]*',
                'fishiriFormat' => 'float number'
            ])
            ->add('ramBopsNumber', 'text', [
                'label' => 'Ram bops number'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('ramBopsManufacturer', 'text', ['label' => 'Ram bops manufacturer'])
            ->add('annularBopsNumber', 'text', [
                'label' => 'Annular bops number'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('annularBopsManufacturer', 'text', ['label' => 'Annular bops manufacturer'])
            ->add('wellheadConnectorType', 'text', ['label' => 'Wellhead connector type'])
            ->add('bopControlSystemType', 'text', ['label' => 'Bop control system type'])
            ->add('bopControlSystemManufacturer', 'text', ['label' => 'Bop control system manufacturer'])
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('bopOperatingPressure')
            ->add('ckLineSize')
            ->add('ramBopsNumber')
            ->add('ramBopsManufacturer')
            ->add('annularBopsNumber')
            ->add('annularBopsManufacturer')
            ->add('wellheadConnectorType')
            ->add('bopControlSystemType')
            ->add('bopControlSystemManufacturer')

            ->add('_action', 'actions', [
                'actions' => [
                    'delete' => [],
                    'edit' => [],
                ]
            ])
        ;
    }
}
