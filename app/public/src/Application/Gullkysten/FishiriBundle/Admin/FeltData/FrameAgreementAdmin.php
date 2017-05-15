<?php

namespace Application\Gullkysten\FishiriBundle\Admin\FeltData;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class FrameAgreementAdmin
 * @package Application\Gullkysten\FishiriBundle\Admin\FeltData
 */
class FrameAgreementAdmin extends AbstractAdmin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('mm', 'text', ['label' => 'MM'])
            ->add('mmContractExpires', 'text', [
                'label' => 'MM contract expires'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('iso', 'text', ['label' => 'ISO'])
            ->add('isoContractExpires', 'text', [
                'label' => 'ISO contract expires'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('drillingAndWell', 'text', ['label' => 'Drilling and well'])
            ->add('drillingAndWellContractExpires', 'text', [
                'label' => 'Drilling and well contract expires'
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
            ->add('mm')
            ->add('mmContractExpires')
            ->add('iso')
            ->add('isoContractExpires')
            ->add('drillingAndWell')
            ->add('drillingAndWellContractExpires')

            ->add('_action', 'actions', [
                'actions' => [
                    'delete' => [],
                    'edit' => [],
                ]
            ])
        ;
    }
}
