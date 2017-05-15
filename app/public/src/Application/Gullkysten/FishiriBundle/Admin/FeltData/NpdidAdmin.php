<?php

namespace Application\Gullkysten\FishiriBundle\Admin\FeltData;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class NpdidAdmin
 * @package Application\Gullkysten\FishiriBundle\Admin\FeltData
 */
class NpdidAdmin extends AbstractAdmin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('owner', 'text', [
                'label' => 'Owner'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('field', 'text', [
                'label' => 'Field'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('wellbore', 'text', [
                'label' => 'Wellbore'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('company', 'text', [
                'label' => 'Company'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('factsLink', 'url', [
                'label' => 'Facts Link'
            ])
            ->add('mapLink', 'url', [
                'label' => 'Map Link'
            ])
            ->add('lastUpdated', 'date', ['label' => 'Last updated', 'disabled' => true])
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('owner')
            ->add('field')
            ->add('wellbore')
            ->add('company')
            ->add('lastUpdated')
            ->add('factsLink')
            ->add('mapLink')

            ->add('_action', 'actions', [
                'actions' => [
                    'delete' => [],
                    'edit' => [],
                ]
            ])
        ;
    }
}
