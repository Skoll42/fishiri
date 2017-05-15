<?php

namespace Application\Gullkysten\FishiriBundle\Admin\FeltData;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class SubseaDevelopmentAdmin
 * @package Application\Gullkysten\FishiriBundle\Admin\FeltData
 */
class SubseaDevelopmentAdmin extends AbstractAdmin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('subseaCompany', 'text', ['label' => 'Subsea company'])
            ->add('subseaTemplate', 'text', [
                'label' => 'Subsea template'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('totalTrees', 'text', [
                'label' => 'Total trees'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('fmc', 'text', [
                'label' => 'FMC'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('aks', 'text', [
                'label' => 'AKS'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('ge', 'text', [
                'label' => 'GE'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('cam', 'text', [
                'label' => 'CAM'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('subseaTieback', 'text', ['label' => 'Subsea tieback'])
            ->add('tiebackDistance', 'text', [
                'label' => 'Tieback distance'
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
            ->add('subseaCompany')
            ->add('subseaTemplate')
            ->add('totalTrees')
            ->add('fmc')
            ->add('aks')
            ->add('ge')
            ->add('cam')
            ->add('subseaTieback')
            ->add('tiebackDistance')

            ->add('_action', 'actions', [
                'actions' => [
                    'delete' => [],
                    'edit' => [],
                ]
            ])
        ;
    }
}
