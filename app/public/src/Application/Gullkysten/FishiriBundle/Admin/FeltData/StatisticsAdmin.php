<?php

namespace Application\Gullkysten\FishiriBundle\Admin\FeltData;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class StatisticsAdmin
 * @package Application\Gullkysten\FishiriBundle\Admin\FeltData
 */
class StatisticsAdmin extends AbstractAdmin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('topWaterDepth', 'text', [
                'label' => 'Top water depth'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('topInvestments', 'text', [
                'label' => 'Top investments'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('topRemainingInvestments', 'text', [
                'label' => 'Top remaining investments'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('topOilDiscovery', 'text', [
                'label' => 'Top oil discovery'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('topGasDiscovery', 'text', [
                'label' => 'Top gas discovery'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('topRemainingOilReserves', 'text', [
                'label' => 'Top remaining oil reserves'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('topRemainingGasReserves', 'text', [
                'label' => 'Top remaining gas reserves'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('topRemainingCondensateReserves', 'text', [
                'label' => 'Top remaining condensate reserves'
            ], [
                'fishiriPattern' => '[-+]?[0-9]*',
                'fishiriFormat' => 'integer number'
            ])
            ->add('topRemainingNglReserves', 'text', [
                'label' => 'Top remaining NGL reserves'
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
            ->add('topWaterDepth')
            ->add('topInvestments')
            ->add('topRemainingInvestments')
            ->add('topOilDiscovery')
            ->add('topGasDiscovery')
            ->add('topRemainingOilReserves')
            ->add('topRemainingGasReserves')
            ->add('topRemainingCondensateReserves')
            ->add('topRemainingNglReserves')

            ->add('_action', 'actions', [
                'actions' => [
                    'delete' => [],
                    'edit' => [],
                ]
            ])
        ;
    }
}
