<?php

namespace Application\Gullkysten\FishiriBundle\Admin\RiggData;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Class RiggDataAdmin
 * @package Application\Gullkysten\FishiriBundle\Admin\RiggData
 */
class RiggDataAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'riggdata';
    protected $baseRoutePattern = 'riggdata';
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
                    'description' => 'This section contains general info about the Rigg',
                    'class' => 'col-xs-12 col-md-8',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'rigId',
                'text',
                [
                    'label' => 'Rig ID'
                ],
                [
                    'fishiriPattern' => '[-+]?[0-9]*',
                    'fishiriFormat' => 'integer number'
                ]
            )
            ->add('name', 'text', ['label' => 'Name'])
            ->add(
                'type',
                'choice',
                [
                    'choices' =>
                        [
                            "semisubmersible" => "semisubmersible",
                            "jackup" => "jackup"
                        ],
                    'multiple' => false,
                    'required' => true,
                    'label' => 'Type'
                ]
            )
            ->end()
            ->with(
                'Status',
                [
                    'description' => 'This section contains info about status of the Rigg',
                    'class' => 'col-xs-12 col-md-4',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'status',
                'choice',
                [
                    'choices' => [
                        "Active" => "Active",
                        "Under construction" => "Under construction",
                        "Unknown" => "Unknown",
                        "Yard" => "Yard",
                        "Idle" => "Idle"
                    ],
                    'multiple' => false,
                    'required' => true,
                    'label' => 'Status'
                ]
            )
            ->add(
                'owner',
                'sonata_type_model',
                [
                    'class' => 'Application\Gullkysten\FishiriBundle\Document\Owner',
                    'label' => 'Owner',
                    'required' => false,
                ]
            )
            ->add(
                'operator',
                'sonata_type_model',
                [
                    'class' => 'Application\Gullkysten\FishiriBundle\Document\Operator',
                    'label' => 'Operator',
                    'required' => false,
                ]
            )
            ->add(
                'lastEdited',
                'date',
                [
                    'label' => 'Last edited',
                    'disabled' => true
                ]
            )
            ->add(
                'created',
                'date',
                [
                    'label' => 'Created',
                    'disabled' => true
                ]
            )
            ->end()
        ->end();

        $formMapper
            ->tab('Rigg Information')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Rigg data/configuration',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'rigInformation',
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
            ->tab('Rigg Ratings')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Rigg ratings',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'rigRatings',
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
            ->tab('Contract Information')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Rigg contract information',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'contractInformation',
                'sonata_type_collection',
                [],
                [
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                    'label' => false,
                    'required' => false,
                    'btn_add' => true,
                    'delete' => true,
                ]
            )
            ->end()
        ->end();

        $formMapper
            ->tab('Vessel Particulars')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Rigg Vessel Particulars',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'vesselParticulars',
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
            ->tab('Vessel Particulars Continued')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Rigg Vessel Particulars Continued',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'vesselParticularsContinued',
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
            ->tab('Lifting Equipment')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Rigg Lifting Equipment',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'liftingEquipment',
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
            ->tab('Drilling Equipment')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Rigg Drilling Equipment',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'drillingEquipment',
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
            ->tab('Mud Systems')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Rigg Mud Systems',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'mudSystems',
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
            ->tab('Riser/Tensioner Data')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Rigg Riser and Tensioner data',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'riserAndRiserTensionerData',
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
            ->tab('Bop/Bop Control Data')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Rigg Bop and Bop Control Data',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'bopAndBopControlData',
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
            ->tab('Landing Facilities')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Rigg Landing Facilities',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'landingFacilities',
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
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Rigg',
                    'class' => 'col-xs-12 col-md-8',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'rigId',
                'text',
                [
                    'label' => 'Rig ID'
                ],
                [
                    'fishiriPattern' => '[-+]?[0-9]*',
                    'fishiriFormat' => 'integer number'
                ]
            )
            ->add('name', 'text', ['label' => 'Name'])
            ->add(
                'type',
                'choice',
                [
                    'choices' =>
                        [
                            "semisubmersible" => "semisubmersible",
                            "jackup" => "jackup"
                        ],
                    'multiple' => false,
                    'required' => true,
                    'label' => 'Type'
                ]
            )
            ->end()
            ->with(
                'Status',
                [
                    'description' => 'This section contains info about status of the Rigg',
                    'class' => 'col-xs-12 col-md-4',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'status',
                'choice',
                [
                    'choices' => [
                        "Active" => "Active",
                        "Under construction" => "Under construction",
                        "Unknown" => "Unknown",
                        "Yard" => "Yard",
                        "Idle" => "Idle"
                    ],
                    'multiple' => false,
                    'required' => true,
                    'label' => 'Status'
                ]
            )
            ->add(
                'owner',
                'sonata_type_admin',
                [
                    'class' => 'Application\Gullkysten\FishiriBundle\Document\Owner',
                    'label' => false,
                    'delete' => false,
                    'btn_add' => false,
                    'required' => false,
                ]
            )
            ->add(
                'operator',
                'sonata_type_model',
                [
                    'class' => 'Application\Gullkysten\FishiriBundle\Document\Operator',
                    'label' => false,
                    'delete' => false,
                    'btn_add' => false,
                    'required' => false,
                ]
            )
            ->add(
                'lastEdited',
                'date',
                [
                    'label' => 'Last edited',
                    'disabled' => true
                ]
            )
            ->add(
                'created',
                'date',
                [
                    'label' => 'Created',
                    'disabled' => true
                ]
            )
            ->end()
        ->end();

        $show
            ->tab('Rigg Information')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Rigg data/configuration',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'rigInformation',
                'sonata_type_admin',
                [
                    'label' => false
                ]
            )
            ->end()
        ->end();

        $show
            ->tab('Rigg Ratings')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Rigg ratings',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'rigRatings',
                'sonata_type_admin',
                [
                    'label' => false
                ]
            )
            ->end()
        ->end();

        $show
            ->tab('Contract Information')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Rigg contract information',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'contractInformation',
                'sonata_type_admin',
                [
                    'label' => false
                ]
            )
            ->end()
        ->end();

        $show
            ->tab('Vessel Particulars')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Rigg Vessel Particulars',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'vesselParticulars',
                'sonata_type_admin',
                [
                    'label' => false
                ]
            )
            ->end()
        ->end();

        $show
            ->tab('Vessel Particulars Continued')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Rigg Vessel Particulars Continued',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'vesselParticularsContinued',
                'sonata_type_admin',
                [
                    'label' => false
                ]
            )
            ->end()
        ->end();

        $show
            ->tab('Lifting Equipment')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Rigg Lifting Equipment',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'liftingEquipment',
                'sonata_type_admin',
                [
                    'label' => false
                ]
            )
            ->end()
        ->end();

        $show
            ->tab('Drilling Equipment')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Rigg Drilling Equipment',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'drillingEquipment',
                'sonata_type_admin',
                [
                    'label' => false
                ]
            )
            ->end()
        ->end();

        $show
            ->tab('Mud Systems')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Rigg Mud Systems',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'mudSystems',
                'sonata_type_admin',
                [
                    'label' => false
                ]
            )
            ->end()
        ->end();

        $show
            ->tab('Riser/Tensioner Data')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Rigg Riser and Tensioner data',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'riserAndRiserTensionerData',
                'sonata_type_admin',
                [
                    'label' => false
                ]
            )
            ->end()
        ->end();

        $show
            ->tab('Bop/Bop Control Data')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Rigg Bop and Bop Control Data',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'bopAndBopControlData',
                'sonata_type_admin',
                [
                    'label' => false
                ]
            )
            ->end()
        ->end();

        $show
            ->tab('Landing Facilities')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Rigg Landing Facilities',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'landingFacilities',
                'sonata_type_admin',
                [
                    'label' => false
                ]
            )
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
            ->add('owner.name')
            ->add('status')
            ->add('type')
            ->add('rigInformation.vesselType')
            ->add('rigInformation.classification');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('rigId')
            ->add('name')
            ->add('status')
            ->add('owner')
            ->add('operator')
            ->add('type')

            ->add('rigInformation.vesselType', 'fishiriAggregate', [
                'aggregateName' => 'Rig information',
                'colspan' => 5,
                'label' => 'Vessel type'
            ])
            ->add('rigInformation.vesselDesign', 'fishiriAggregate', [
                'label' => 'Vessel design'
            ])
            ->add('rigInformation.constructionDate', 'fishiriAggregate', [
                'label' => 'Construction date'
            ])
            ->add('rigInformation.upgradeDate', 'fishiriAggregate', [
                'label' => 'Upgrade date'
            ])
            ->add('rigInformation.classification', 'fishiriAggregate', [
                'label' => 'Classification'
            ])

            ->add('rigRatings.maximumWaterDepth', 'fishiriAggregate', [
                'aggregateName' => 'Rig ratings',
                'colspan' => 2,
                'label' => 'Maximum water depth'
            ])
            ->add('rigRatings.maximumDrillingDepth', 'fishiriAggregate', [
                'label' => 'Maximum drilling depth'
            ])

            ->add('contractInformation.status', 'fishiriAggregate', [
                'aggregateName' => 'Contract information',
                'colspan' => 3,
                'label' => 'Status'
            ])
            ->add('vesselParticulars.totalVesselPower', 'fishiriAggregate', [
                'aggregateName' => 'Vessel particulars',
                'colspan' => 9,
                'label' => 'Total vessel power'
            ])
            ->add('vesselParticulars.maximumVesselSpeed', 'fishiriAggregate', [
                'label' => 'Maximum vessel speed'
            ])
            ->add('vesselParticulars.quartersCapacity', 'fishiriAggregate', [
                'label' => 'Quarters capacity'
            ])
            ->add('vesselParticulars.length', 'fishiriAggregate', [
                'label' => 'Length'
            ])
            ->add('vesselParticulars.width', 'fishiriAggregate', [
                'label' => 'Width'
            ])
            ->add('vesselParticulars.transitDraft', 'fishiriAggregate', [
                'label' => 'Transit draft'
            ])
            ->add('vesselParticulars.operationDraft', 'fishiriAggregate', [
                'label' => 'Operation draft'
            ])
            ->add('vesselParticulars.maximumVariableLoad', 'fishiriAggregate', [
                'label' => 'Maximum variable load'
            ])
            ->add('vesselParticulars.moonpoolSize', 'fishiriAggregate', [
                'label' => 'Moonpool size'
            ])

            ->add('vesselParticularsContinued.thrusters', 'fishiriAggregate', [
                'aggregateName' => 'Vessel particulars continued',
                'colspan' => 7,
                'label' => 'Thrusters'
            ])
            ->add('vesselParticularsContinued.sizeOfChain', 'fishiriAggregate', [
                'label' => 'Size of chain'
            ])
            ->add('vesselParticularsContinued.chainGrade', 'fishiriAggregate', [
                'label' => 'Chain grade'
            ])
            ->add('vesselParticularsContinued.lengthOfChain', 'fishiriAggregate', [
                'label' => 'Length of chain'
            ])
            ->add('vesselParticularsContinued.wireRopeDiameter', 'fishiriAggregate', [
                'label' => 'Wire rope diameter'
            ])
            ->add('vesselParticularsContinued.lengthOfWireRope', 'fishiriAggregate', [
                'label' => 'Length of wire rope'
            ])
            ->add('vesselParticularsContinued.anchorSize', 'fishiriAggregate', [
                'label' => 'Anchor size'
            ])

            ->add('liftingEquipment.pedestalCrane1', 'fishiriAggregate', [
                'aggregateName' => 'Lifting equipment',
                'colspan' => 5,
                'label' => 'Pedestal crane 1'
            ])
            ->add('liftingEquipment.pedestalCrane2', 'fishiriAggregate', [
                'label' => 'Pedestal crane 2'
            ])
            ->add('liftingEquipment.pedestalCrane3', 'fishiriAggregate', [
                'label' => 'Pedestal crane 3'
            ])
            ->add('liftingEquipment.pedestalCrane4', 'fishiriAggregate', [
                'label' => 'Pedestal crane 4'
            ])
            ->add('liftingEquipment.riserHandlingCrane', 'fishiriAggregate', [
                'label' => 'Riser handling crane'
            ])

            ->add('drillingEquipment.derrickRating', 'fishiriAggregate', [
                'aggregateName' => 'Drilling equipment',
                'colspan' => 12,
                'label' => 'Derrick rating'
            ])
            ->add('drillingEquipment.derrickManufacturer', 'fishiriAggregate', [
                'label' => 'Derrick manufacturer'
            ])
            ->add('drillingEquipment.derrickFootprint', 'fishiriAggregate', [
                'label' => 'Derrick footprint'
            ])
            ->add('drillingEquipment.drawworksPower', 'fishiriAggregate', [
                'label' => 'Drawworks power'
            ])
            ->add('drillingEquipment.drawworksManufacturer', 'fishiriAggregate', [
                'label' => 'Drawworks manufacturer'
            ])
            ->add('drillingEquipment.drillLineSize', 'fishiriAggregate', [
                'label' => 'Drill line size'
            ])
            ->add('drillingEquipment.rotaryTableSize', 'fishiriAggregate', [
                'label' => 'Rotary table size'
            ])
            ->add('drillingEquipment.ironRoughneck', 'fishiriAggregate', [
                'label' => 'Iron roughneck'
            ])
            ->add('drillingEquipment.topDrive', 'fishiriAggregate', [
                'label' => 'Top drive'
            ])
            ->add('drillingEquipment.heaveCompensatorManufacturer', 'fishiriAggregate', [
                'label' => 'Heave compensator manufacturer'
            ])
            ->add('drillingEquipment.heaveCompensatorCapacity', 'fishiriAggregate', [
                'label' => 'Heave compensator capacity'
            ])
            ->add('drillingEquipment.pipeRackingSystem', 'fishiriAggregate', [
                'label' => 'Pipe racking system'
            ])

            ->add('mudSystems.mudPumpsNumber', 'fishiriAggregate', [
                'aggregateName' => 'Mud systems',
                'colspan' => 8,
                'label' => 'Mud pumps number'
            ])
            ->add('mudSystems.mudPumpsManufacturerAndModel', 'fishiriAggregate', [
                'label' => 'Mud pumps manufacturer and model'
            ])
            ->add('mudSystems.liquidMud', 'fishiriAggregate', [
                'label' => 'Liquid mud'
            ])
            ->add('mudSystems.fuelOil', 'fishiriAggregate', [
                'label' => 'Fuel oil'
            ])
            ->add('mudSystems.bulkStorageCapacity', 'fishiriAggregate', [
                'label' => 'Bulk storage capacity'
            ])
            ->add('mudSystems.shaleShakers', 'fishiriAggregate', [
                'label' => 'Shale shakers'
            ])
            ->add('mudSystems.desander', 'fishiriAggregate', [
                'label' => 'Desander'
            ])
            ->add('mudSystems.desilter', 'fishiriAggregate', [
                'label' => 'Desilter'
            ])

            ->add('riserAndRiserTensionerData.riserTensionersTotalCapacity', 'fishiriAggregate', [
                'aggregateName' => 'Riser and riser tensioner data',
                'colspan' => 7,
                'label' => 'Riser tensioners total capacity'
            ])
            ->add('riserAndRiserTensionerData.riserTensionersNumber', 'fishiriAggregate', [
                'label' => 'Tiser tensioners number'
            ])
            ->add('riserAndRiserTensionerData.riserTensionersManufacturer', 'fishiriAggregate', [
                'label' => 'Riser tensioners manufacturer'
            ])
            ->add('riserAndRiserTensionerData.diverterSize', 'fishiriAggregate', [
                'label' => 'Diverter size'
            ])
            ->add('riserAndRiserTensionerData.riserSize', 'fishiriAggregate', [
                'label' => 'Riser size'
            ])
            ->add('riserAndRiserTensionerData.riserJointLength', 'fishiriAggregate', [
                'label' => 'Riser joint length'
            ])
            ->add('riserAndRiserTensionerData.riserManufacturer', 'fishiriAggregate', [
                'label' => 'Riser manufacturer'
            ])

            ->add('bopAndBopControlData.bopOperatingPressure', 'fishiriAggregate', [
                'aggregateName' => 'Bop and bop control data',
                'colspan' => 9,
                'label' => 'Bop operating pressure'
            ])
            ->add('bopAndBopControlData.ckLineSize', 'fishiriAggregate', [
                'label' => 'CK line size'
            ])
            ->add('bopAndBopControlData.ramBopsNumber', 'fishiriAggregate', [
                'label' => 'Ram bops number'
            ])
            ->add('bopAndBopControlData.ramBopsManufacturer', 'fishiriAggregate', [
                'label' => 'Ram bops manufacturer'
            ])
            ->add('bopAndBopControlData.annularBopsNumber', 'fishiriAggregate', [
                'label' => 'Annular bops number'
            ])
            ->add('bopAndBopControlData.annularBopsManufacturer', 'fishiriAggregate', [
                'label' => 'Annular bops manufacturer'
            ])
            ->add('bopAndBopControlData.wellheadConnectorType', 'fishiriAggregate', [
                'label' => 'Wellhead connector type'
            ])
            ->add('bopAndBopControlData.bopControlSystemType', 'fishiriAggregate', [
                'label' => 'Bop control system type'
            ])
            ->add('bopAndBopControlData.bopControlSystemManufacturer', 'fishiriAggregate', [
                'label' => 'Bop control system manufacturer'
            ])

            ->add('landingFacilities.helideckType', 'fishiriAggregate', [
                'aggregateName' => 'Landing facilities',
                'colspan' => 2,
                'label' => 'Helideck type'
            ])
            ->add('landingFacilities.helideckSize', 'fishiriAggregate', [
                'label' => 'Helideck size'
            ])

            ->add('lastEdited')
            ->add('created')

            ->add('_action', 'actions', [
                'actions' => [
                    'delete' => [],
                    'edit' => [],
                ]
            ])
        ;
    }
}
