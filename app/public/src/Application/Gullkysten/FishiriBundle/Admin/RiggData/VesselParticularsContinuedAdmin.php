<?php

namespace Application\Gullkysten\FishiriBundle\Admin\RiggData;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class VesselParticularsContinuedAdmin
 * @package Application\Gullkysten\FishiriBundle\Admin\RiggData
 */
class VesselParticularsContinuedAdmin extends AbstractAdmin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('thrusters', 'text', ['label' => 'Thrusters'])
            ->add('sizeOfChain', 'text', [
                'label' => 'Size of chain'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*\.?[0-9]*',
                'fishiriFormat' => 'float number'
            ])
            ->add('chainGrade', 'text', ['label' => 'Chain grade'])
            ->add('lengthOfChain', 'text', [
                'label' => 'Length of chain'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('wireRopeDiameter', 'text', [
                'label' => 'Wire rope diameter'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*\.?[0-9]*',
                'fishiriFormat' => 'float number'
            ])
            ->add('lengthOfWireRope', 'text', [
                'label' => 'Length of wire rope'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('anchorSize', 'text', ['label' => 'Anchor size'])
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('thrusters')
            ->add('sizeOfChain')
            ->add('chainGrade')
            ->add('lengthOfChain')
            ->add('wireRopeDiameter')
            ->add('lengthOfWireRope')
            ->add('anchorSize')

            ->add('_action', 'actions', [
                'actions' => [
                    'delete' => [],
                    'edit' => [],
                ]
            ])
        ;
    }
}
