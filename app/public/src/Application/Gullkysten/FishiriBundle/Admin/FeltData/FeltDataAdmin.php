<?php

namespace Application\Gullkysten\FishiriBundle\Admin\FeltData;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Class FeltDataAdmin
 * @package Application\Gullkysten\FishiriBundle\Admin\FeltData
 */
class FeltDataAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'feltdata';
    protected $baseRoutePattern = 'feltdata';
    protected $searchResultActions = ['edit', 'show', 'list'];

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('General')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Felt',
                    'class' => 'col-xs-12 col-md-8',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add('name', 'text', ['label' => 'Name'])
            ->add(
                'operator',
                'sonata_type_model',
                ['class' => 'Application\Gullkysten\FishiriBundle\Document\Operator', 'btn_add' => false]
            )
            ->add(
                'waterDepth',
                'text',
                [
                    'label' => 'Water depth'
                ],
                [
                    'fishiriPattern' => '[-+]?[0-9]*',
                    'fishiriFormat' => 'integer number'
                ]
            )
            ->add('description', 'textarea', ['label' => 'Description'])
            ->add(
                'discoveryYear',
                'text',
                [
                    'label' => 'Discovery year'
                ],
                [
                    'fishiriPattern' => '[-+]?[0-9]*',
                    'fishiriFormat' => 'integer number'
                ]
            )
            ->add(
                'onStream',
                'text',
                [
                    'label' => 'Production start'
                ],
                [
                    'fishiriPattern' => '[-+]?[0-9]*',
                    'fishiriFormat' => 'integer number'
                ]
            )
            ->add('productionLicense', 'text', ['label' => 'Production license'])
            ->end()
            ->with(
                'Status and location',
                [
                    'description' => 'This section contains info about status and location of the Felt',
                    'class' => 'col-xs-12 col-md-4',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'status',
                'choice',
                [
                    'choices' => [
                        "PUD" => "PUD",
                        "FUTURE PROJECTS" => "FUTURE PROJECTS",
                        "PDO APPROVED" => "PDO APPROVED",
                        "SHUT DOWN" => "SHUT DOWN",
                        "PRODUCING" => "PRODUCING"
                    ],
                    'multiple' => false,
                    'required' => true,
                    'label' => 'Status'
                ]
            )
            ->add(
                'location',
                'choice',
                [
                    'choices' => [
                        "Nordsjøen (nord)",
                        "Nordsjøen (midtre)",
                        "Nordsjøen (sør)",
                        "Norskehavet",
                        "Barentshavet"
                    ],
                    'multiple' => false,
                    'required' => true,
                    'label' => 'Location'
                ]
            )
            ->add('supplyBase', 'text', ['label' => 'Supply base'])
            ->add('created', 'date', ['disabled' => true])
            ->add('lastEdited', 'date', ['disabled' => true])
            ->end()
        ->end();

        $formMapper
            ->tab('Investments')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Felt Investments',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'investments',
                'sonata_type_admin',
                [
                    'label' => false,
                    'delete' => false,
                    'btn_add' => false,
                    'required' => false,
                ],
                [
                    'fishiriAggregate' => true,
                ]
            )
            ->end()
        ->end();

        $formMapper
            ->tab('Frame Agreement')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Felt Frame Agreement',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'frameAgreement',
                'sonata_type_admin',
                [
                    'label' => false,
                    'delete' => false,
                    'btn_add' => false,
                    'required' => false,
                ],
                [
                    'fishiriAggregate' => true,
                ]
            )
            ->end()
        ->end();

        $formMapper
            ->tab('Field Development')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Felt Field Development',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'fieldDevelopment',
                'sonata_type_admin',
                [
                    'label' => false,
                    'delete' => false,
                    'btn_add' => false,
                    'required' => false
                ],
                [
                    'fishiriAggregate' => true,
                ]
            )
            ->end()
        ->end();

        $formMapper
            ->tab('Subsea Development')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Felt Subsea Development',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'subseaDevelopment',
                'sonata_type_admin',
                [
                    'label' => false,
                    'delete' => false,
                    'btn_add' => false,
                    'required' => false
                ],
                [
                    'fishiriAggregate' => true,
                ]
            )
            ->end()
        ->end();

        $formMapper
            ->tab('Drilling Wells')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Felt Drilling Wells',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'drillingWells',
                'sonata_type_admin',
                [
                    'label' => false,
                    'delete' => false,
                    'btn_add' => false,
                    'required' => false
                ],
                [
                    'fishiriAggregate' => true,
                ]
            )
            ->end()
        ->end();

        $formMapper
            ->tab('Remaining Reserves')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Felt Remaining Reserves',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'remainingReserves',
                'sonata_type_admin',
                [
                    'label' => false,
                    'delete' => false,
                    'btn_add' => false,
                    'required' => false
                ],
                [
                    'fishiriAggregate' => true,
                ]
            )
            ->end()
        ->end();

        $formMapper
            ->tab('Total Reserves Estimate')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Felt Total Reserves Estimates',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'totalReservesEstimate',
                'sonata_type_admin',
                [
                    'label' => false,
                    'delete' => false,
                    'btn_add' => false,
                    'required' => false
                ],
                [
                    'fishiriAggregate' => true,
                ]
            )
            ->end()
        ->end();

        $formMapper
            ->tab('Export Technology')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Felt Export Technology',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'exportTechnology',
                'sonata_type_admin',
                [
                    'label' => false,
                    'delete' => false,
                    'btn_add' => false,
                    'required' => false
                ],
                [
                    'fishiriAggregate' => true,
                ]
            )
            ->end()
        ->end();

        $formMapper
            ->tab('Destination')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Felt Destination',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'destination',
                'sonata_type_admin',
                [
                    'label' => false,
                    'delete' => false,
                    'btn_add' => false,
                    'required' => false
                ],
                [
                    'fishiriAggregate' => true,
                ]
            )
            ->end()
        ->end();

        $formMapper
            ->tab('Helicopter')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Felt Helicopter',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'helicopter',
                'sonata_type_admin',
                [
                    'label' => false,
                    'delete' => false,
                    'btn_add' => false,
                    'required' => false
                ],
                [
                    'fishiriAggregate' => true,
                ]
            )
            ->end()
        ->end();

        $formMapper
            ->tab('Statistics')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Felt Statistics',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'statistics',
                'sonata_type_admin',
                [
                    'label' => false,
                    'delete' => false,
                    'btn_add' => false,
                    'required' => false
                ],
                [
                    'fishiriAggregate' => true,
                ]
            )
            ->end()
        ->end();

        $formMapper
            ->tab('NPDID')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Felt NPDID',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'npdid',
                'sonata_type_admin',
                [
                    'label' => false,
                    'delete' => false,
                    'btn_add' => false,
                    'required' => false
                ],
                [
                    'fishiriAggregate' => true,
                ]
            )
            ->end()
        ->end();

        $formMapper
            ->tab('Gallery')
            ->with(
                'General',
                [
                    'description' => 'This section contains image gallery',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'gallery',
                'sonata_type_model_list',
                [
                    'required' => false
                ],
                [
                    'link_parameters' =>
                        [
                            'context' => 'default'
                        ],
                    'btn_add' => false,
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position'
                ]
            )
            ->end()
        ->end();
    }

    /**
     * @param ShowMapper $show
     */
    protected function configureShowFields(ShowMapper $show)
    {
        $show
            ->tab('General')
            ->with('General', [
                'description' => 'This section contains general info about the Felt',
                'class' => 'col-xs-12 col-md-8',
                'box_class' => 'box box-primary box-solid',
            ])
            ->add('name', 'text', ['label' => 'Name'])
            ->add(
                'operator',
                'sonata_type_model',
                ['class' => 'Application\Gullkysten\FishiriBundle\Document\Operator']
            )
            ->add('waterDepth', 'text', [
                'label' => 'Water depth'
            ])
            ->add('description', 'text', ['label' => 'Description'])
            ->add('discoveryYear', 'text', [
                'label' => 'Discovery year'
            ])
            ->add('onStream', 'text', [
                'label' => 'Production start'
            ])
            ->add('productionLicense', 'text', ['label' => 'Production license'])
            ->end()
            ->with('Status and location', [
                'description' => 'This section contains info about status and location of the Felt',
                'class' => 'col-xs-12 col-md-4',
                'box_class' => 'box box-primary box-solid',
            ])
            ->add('status', 'choice', [
                'choices' => [
                    "PUD" => "PUD",
                    "FUTURE PROJECTS" => "FUTURE PROJECTS",
                    "PDO APPROVED" => "PDO APPROVED",
                    "SHUT DOWN" => "SHUT DOWN",
                    "PRODUCING" => "PRODUCING"
                ],
                'label' => 'Status'
            ])
            ->add('location', 'choice', [
                'choices' => [
                    "Nordsjøen (nord)",
                    "Nordsjøen (midtre)",
                    "Nordsjøen (sør)",
                    "Norskehavet",
                    "Barentshavet"
                ],
                'label' => 'Location'
            ])
            ->add('supplyBase', 'text', ['label' => 'Supply base'])
            ->add('created', 'date')
            ->add('lastEdited', 'date')
            ->end()
        ->end();

        $show
            ->tab('Investments')
            ->with('General', [
                'description' => 'This section contains general info about the Felt Investments',
                'class' => 'col-xs-12',
                'box_class' => 'box box-primary box-solid',
            ])
            ->add('investments', 'sonata_type_admin', [
                'label' => false
            ])
            ->end()
        ->end();

        $show
            ->tab('Frame Agreement')
            ->with('General', [
                'description' => 'This section contains general info about the Felt Frame Agreement',
                'class' => 'col-xs-12',
                'box_class' => 'box box-primary box-solid',
            ])
            ->add('frameAgreement', 'sonata_type_admin', [
                'label' => false
            ])
            ->end()
        ->end();

        $show
            ->tab('Field Development')
            ->with('General', [
                'description' => 'This section contains general info about the Felt Field Development',
                'class' => 'col-xs-12',
                'box_class' => 'box box-primary box-solid',
            ])
            ->add('fieldDevelopment', 'sonata_type_admin', [
                'label' => false
            ])
            ->end()
        ->end();

        $show
            ->tab('Subsea Development')
            ->with('General', [
                'description' => 'This section contains general info about the Felt Subsea Development',
                'class' => 'col-xs-12',
                'box_class' => 'box box-primary box-solid',
            ])
            ->add('subseaDevelopment', 'sonata_type_admin', [
                'label' => false
            ])
            ->end()
        ->end();

        $show
            ->tab('Drilling Wells')
            ->with('General', [
                'description' => 'This section contains general info about the Felt Drilling Wells',
                'class' => 'col-xs-12',
                'box_class' => 'box box-primary box-solid',
            ])
            ->add('drillingWells', 'sonata_type_admin', [
                'label' => false
            ])
            ->end()
        ->end();

        $show
            ->tab('Remaining Reserves')
            ->with('General', [
                'description' => 'This section contains general info about the Felt Remaining Reserves',
                'class' => 'col-xs-12',
                'box_class' => 'box box-primary box-solid',
            ])
            ->add('remainingReserves', 'sonata_type_admin', [
                'label' => false
            ])
            ->end()
        ->end();

        $show
            ->tab('Total Reserves Estimate')
            ->with('General', [
                'description' => 'This section contains general info about the Felt Total Reserves Estimates',
                'class' => 'col-xs-12',
                'box_class' => 'box box-primary box-solid',
            ])
            ->add('totalReservesEstimate', 'sonata_type_admin', [
                'label' => false
            ])
            ->end()
        ->end();

        $show
            ->tab('Export Technology')
            ->with('General', [
                'description' => 'This section contains general info about the Felt Export Technology',
                'class' => 'col-xs-12',
                'box_class' => 'box box-primary box-solid',
            ])
            ->add('exportTechnology', 'sonata_type_admin', [
                'label' => false
            ])
            ->end()
        ->end();

        $show
            ->tab('Destination')
            ->with('General', [
                'description' => 'This section contains general info about the Felt Destination',
                'class' => 'col-xs-12',
                'box_class' => 'box box-primary box-solid',
            ])
            ->add('destination', 'sonata_type_admin', [
                'label' => false
            ])
            ->end()
        ->end();

        $show
            ->tab('Helicopter')
            ->with('General', [
                'description' => 'This section contains general info about the Felt Helicopter',
                'class' => 'col-xs-12',
                'box_class' => 'box box-primary box-solid',
            ])
            ->add('helicopter', 'sonata_type_admin', [
                'label' => false
            ])
            ->end()
        ->end();

        $show
            ->tab('Statistics')
            ->with('General', [
                'description' => 'This section contains general info about the Felt Statistics',
                'class' => 'col-xs-12',
                'box_class' => 'box box-primary box-solid',
            ])
            ->add('statistics', 'sonata_type_admin', [
                'label' => false
            ])
            ->end()
        ->end();

        $show
            ->tab('NPDID')
            ->with('General', [
                'description' => 'This section contains general info about the Felt NPDID',
                'class' => 'col-xs-12',
                'box_class' => 'box box-primary box-solid',
            ])
            ->add('npdid', 'sonata_type_admin', [
                'label' => false
            ])
            ->end()
        ->end();

        $show
            ->tab('Gallery')
            ->with(
                'General',
                [
                    'description' => 'This section contains image gallery',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'gallery',
                'sonata_type_model_list',
                [],
                [
                    'link_parameters' =>
                        [
                            'context' => 'default'
                        ]
                ]
            )
            ->end()
        ->end();
    }

    /**
     * @param DatagridMapper $datagrid
     */
    protected function configureDatagridFilters(DatagridMapper $datagrid)
    {
        $datagrid
            ->add('name')
            ->add('operator.name')
            ->add('status')
            ->add('location')
            ->add('description')
            ->add('supplyBase')
            ->add('investments.totalInvestments');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('operator')
            ->add('status')
            ->add('location')
            ->add('description')
            ->add('discoveryYear')
            ->add('onStream')
            ->add('productionLicense')
            ->add('waterDepth')
            ->add('supplyBase')

            ->add('investments.totalInvestments', 'fishiriAggregate', [
                'aggregateName' => 'Investments',
                'colspan' => 3,
                'label' => 'Total investments'
            ])
            ->add('investments.remainingInvestments', 'fishiriAggregate', [
                'label' => 'Remaining investments'
            ])
            ->add('investments.soFarInvestments', 'fishiriAggregate', [
                'label' => 'So far investments'
            ])

            ->add('frameAgreement.mm', 'fishiriAggregate', [
                'aggregateName' => 'Frame agreement',
                'colspan' => 6,
                'label' => 'MM'
            ])
            ->add('frameAgreement.mmContractExpires', 'fishiriAggregate', [
                'label' => 'MM contract expires'
            ])
            ->add('frameAgreement.iso', 'fishiriAggregate', [
                'label' => 'ISO'
            ])
            ->add('frameAgreement.isoContractExpires', 'fishiriAggregate', [
                'label' => 'ISO contract expires'
            ])
            ->add('frameAgreement.drillingAndWell', 'fishiriAggregate', [
                'label' => 'Drilling and well'
            ])
            ->add('frameAgreement.drillingAndWellContractExpires', 'fishiriAggregate', [
                'label' => 'Drilling and well contract expires'
            ])

            ->add('fieldDevelopment.productionStructure', 'fishiriAggregate', [
                'aggregateName' => 'Main development',
                'colspan' => 4,
                'label' => 'Production structure'
            ])
            ->add('fieldDevelopment.productionDrillingQuarters', 'fishiriAggregate', [
                'label' => 'Production drilling quarters'
            ])
            ->add('fieldDevelopment.material', 'fishiriAggregate', [
                'label' => 'Material'
            ])
            ->add('fieldDevelopment.additionalInfo', 'fishiriAggregate', [
                'label' => 'Additional info'
            ])

            ->add('subseaDevelopment.subseaCompany', 'fishiriAggregate', [
                'aggregateName' => 'Subsea development',
                'colspan' => 9,
                'label' => 'Subsea company'
            ])
            ->add('subseaDevelopment.subseaTemplate', 'fishiriAggregate', [
                'label' => 'Subsea template'
            ])
            ->add('subseaDevelopment.totalTrees', 'fishiriAggregate', [
                'label' => 'Total trees'
            ])
            ->add('subseaDevelopment.fmc', 'fishiriAggregate', [
                'label' => 'FMC'
            ])
            ->add('subseaDevelopment.aks', 'fishiriAggregate', [
                'label' => 'AKS'
            ])
            ->add('subseaDevelopment.ge', 'fishiriAggregate', [
                'label' => 'GE'
            ])
            ->add('subseaDevelopment.cam', 'fishiriAggregate', [
                'label' => 'CAM'
            ])
            ->add('subseaDevelopment.subseaTieback', 'fishiriAggregate', [
                'label' => 'Subsea tieback'
            ])
            ->add('subseaDevelopment.tiebackDistance', 'fishiriAggregate', [
                'label' => 'Tieback distance'
            ])

            ->add('drillingWells.exploration', 'fishiriAggregate', [
                'aggregateName' => 'Drilling wells',
                'colspan' => 3,
                'label' => 'Exploration'
            ])
            ->add('drillingWells.development', 'fishiriAggregate', [
                'label' => 'Development'
            ])
            ->add('drillingWells.topReservoirDepth', 'fishiriAggregate', [
                'label' => 'Top reservoir depth'
            ])

            ->add('remainingReserves.oil', 'fishiriAggregate', [
                'aggregateName' => 'Remaining reserves',
                'colspan' => 4,
                'label' => 'Oil'
            ])
            ->add('remainingReserves.oilBarrels', 'fishiriAggregate', [
                'label' => 'Oil barrels'
            ])
            ->add('remainingReserves.atCurrentOilPrice', 'fishiriAggregate', [
                'label' => 'At current oil price'
            ])
            ->add('remainingReserves.gas', 'fishiriAggregate', [
                'label' => 'Gas'
            ])

            ->add('totalReservesEstimate.oil', 'fishiriAggregate', [
                'aggregateName' => 'Total reserves estimate',
                'colspan' => 4,
                'label' => 'Oil'
            ])
            ->add('totalReservesEstimate.gas', 'fishiriAggregate', [
                'label' => 'Gas'
            ])
            ->add('totalReservesEstimate.condensate', 'fishiriAggregate', [
                'label' => 'Condensate'
            ])
            ->add('totalReservesEstimate.ngl', 'fishiriAggregate', [
                'label' => 'NGL'
            ])

            ->add('exportTechnology.oil', 'fishiriAggregate', [
                'aggregateName' => 'Export technology',
                'colspan' => 3,
                'label' => 'Oil'
            ])
            ->add('exportTechnology.gas', 'fishiriAggregate', [
                'label' => 'Gas'
            ])
            ->add('exportTechnology.condensate', 'fishiriAggregate', [
                'label' => 'Condensate'
            ])

            ->add('destination.oil', 'fishiriAggregate', [
                'aggregateName' => 'Destination',
                'colspan' => 3,
                'label' => 'Oil'
            ])
            ->add('destination.gas', 'fishiriAggregate', [
                'label' => 'Gas'
            ])
            ->add('destination.condensate', 'fishiriAggregate', [
                'label' => 'Condensate'
            ])

            ->add('helicopter.flightService', 'fishiriAggregate', [
                'aggregateName' => 'Helicopter',
                'colspan' => 3,
                'label' => 'Flight service'
            ])
            ->add('helicopter.flightBase', 'fishiriAggregate', [
                'label' => 'Flight base'
            ])
            ->add('helicopter.offshoreBased', 'fishiriAggregate', [
                'label' => 'Offshore based'
            ])

            ->add('statistics.topWaterDepth', 'fishiriAggregate', [
                'aggregateName' => 'Statistics',
                'colspan' => 9,
                'label' => 'Top water depth'
            ])
            ->add('statistics.topInvestments', 'fishiriAggregate', [
                'label' => 'Top investments'
            ])
            ->add('statistics.topRemainingInvestments', 'fishiriAggregate', [
                'label' => 'Top remaining investments'
            ])
            ->add('statistics.topOilDiscovery', 'fishiriAggregate', [
                'label' => 'Top oil discovery'
            ])
            ->add('statistics.topGasDiscovery', 'fishiriAggregate', [
                'label' => 'Top gas discovery'
            ])
            ->add('statistics.topRemainingOilReserves', 'fishiriAggregate', [
                'label' => 'Top remaining oil reserves'
            ])
            ->add('statistics.topRemainingGasReserves', 'fishiriAggregate', [
                'label' => 'Top remaining gas reserves'
            ])
            ->add('statistics.topRemainingCondensateReserves', 'fishiriAggregate', [
                'label' => 'Top remaining condensate reserves'
            ])
            ->add('statistics.topRemainingNglReserves', 'fishiriAggregate', [
                'label' => 'Top remaining NGL reserves'
            ])

            ->add('npdid.owner', 'fishiriAggregate', [
                'aggregateName' => 'NPDID',
                'colspan' => 4,
                'label' => 'Owner'
            ])
            ->add('npdid.field', 'fishiriAggregate', [
                'label' => 'Field'
            ])
            ->add('npdid.wellbore', 'fishiriAggregate', [
                'label' => 'Wellbore'
            ])
            ->add('npdid.company', 'fishiriAggregate', [
                'label' => 'Company'
            ])

            ->add('created')
            ->add('lastEdited')

            ->add('_action', 'actions', [
                'actions' => [
                    'delete' => [],
                    'edit' => [],
                ]
            ])
        ;
    }
}
