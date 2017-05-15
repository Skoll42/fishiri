<?php

namespace Application\Gullkysten\FishiriBundle\Admin\RiggData;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class RiserAndRiserTensionerDataAdmin
 * @package Application\Gullkysten\FishiriBundle\Admin\RiggData
 */
class RiserAndRiserTensionerDataAdmin extends AbstractAdmin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('riserTensionersTotalCapacity', 'text', [
                'label' => 'Riser tensioners total capacity'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('riserTensionersNumber', 'text', [
                'label' => 'Riser tensioners number'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('riserTensionersManufacturer', 'text', ['label' => 'Riser tensioners manufacturer'])
            ->add('diverterSize', 'text', [
                'label' => 'Diverter size'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*\.?[0-9]*',
                'fishiriFormat' => 'float number'
            ])
            ->add('riserSize', 'text', [
                'label' => 'Riser size'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('riserJointLength', 'text', [
                'label' => 'Riser joint length'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('riserManufacturer', 'text', ['label' => 'Riser manufacturer'])
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('riserTensionersTotalCapacity')
            ->add('riserTensionersNumber')
            ->add('riserTensionersManufacturer')
            ->add('diverterSize')
            ->add('riserSize')
            ->add('riserJointLength')
            ->add('riserManufacturer')

            ->add('_action', 'actions', [
                'actions' => [
                    'delete' => [],
                    'edit' => [],
                ]
            ])
        ;
    }
}
