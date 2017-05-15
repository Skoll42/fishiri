<?php

namespace Application\Gullkysten\FishiriBundle\Admin\DockedShips;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Class DockedShipsAdmin
 * @package Application\Gullkysten\FishiriBundle\Admin\DockedShips
 */
class DockedShipsAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'dockedships';
    protected $baseRoutePattern = 'dockedships';
    protected $searchResultActions = ['edit', 'show', 'list'];

    /**
     * @param FormMapper $formMapper
     */
    public function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('General')
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the ship',
                    'class' => 'col-xs-12 col-md-8',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add('name', 'text', ['label' => 'Name'])
            ->add(
                'typeSkip',
                'text',
                [
                    'label' => 'Type Skip'
                ]
            )
            ->add('flagg', 'text', ['label' => 'Flag', 'required' => false ])
            ->add('owner', 'sonata_type_model', ['class' => 'Application\Gullkysten\FishiriBundle\Document\Owner'])
        ->end();
        $formMapper
            ->with(
                'Status',
                [
                    'description' => 'This section contains info about ship status and latest changes',
                    'class' => 'col-xs-12 col-md-4',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'status',
                'text',
                [
                    'label' => 'Status'
                ]
            )
            ->add('dateIn', 'date', ['label' => 'Date In'])
            ->add('dateOut', 'date', ['label' => 'Date Out', 'required' => false])
            ->add('lastEdited', 'date', ['disabled' => true])
        ->end();
        $formMapper
            ->with(
                'Location',
                [
                    'description' => 'This section contains general info about ship location',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'latlng',
                'oh_google_maps',
                [
                    'lat_options'  =>
                        [
                            'label' => 'Latitude'
                        ],
                    'lng_options'  =>
                        [
                            'label' => 'Longitude'
                        ],
                    'label' => 'Map',
                    'map_width' => '100%',
                    'error_bubbling' => true,
                    'include_jquery' => false,
                ]
            )
            ->add('locationName', 'text', [
                'label' => 'Location Name'
            ])
            ->end()
        ->end();

        $formMapper
            ->tab('Media')
            ->with(
                'General',
                [
                    'description' => 'This section contains connected media',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'media',
                'sonata_media_type',
                [
                    'provider' => 'sonata.media.provider.image',
                    'context' => 'default'
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
                    'description' => 'This section contains general info about the ship',
                    'class' => 'col-xs-12 col-md-8',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add('name', 'text', ['label' => 'Name'])
            ->add(
                'typeSkip',
                'text',
                [
                    'label' => 'Type Skip'
                ]
            )
            ->add('flagg', 'text', ['label' => 'Flag', 'required' => false ])
            ->add('owner', 'sonata_type_model', ['class' => 'Application\Gullkysten\FishiriBundle\Document\Owner'])
        ->end();
        $show
            ->with(
                'Status',
                [
                    'description' => 'This section contains info about ship status and latest changes',
                    'class' => 'col-xs-12 col-md-4',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'status',
                'text',
                [
                    'label' => 'Status'
                ]
            )
            ->add('dateIn', 'date', ['label' => 'Date In'])
            ->add('dateOut', 'date', ['label' => 'Date Out'])
            ->add('lastEdited', 'date', ['disabled' => true])
        ->end();
        $show
            ->with(
                'Location',
                [
                    'description' => 'This section contains general info about ship location',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'latlng',
                'oh_google_maps',
                [
                    'lat_options'  =>
                        [
                            'label' => 'Latitude'
                        ],
                    'lng_options'  =>
                        [
                            'label' => 'Longitude'
                        ],
                    'label' => 'Map',
                    'map_width' => '100%',
                    'error_bubbling' => true,
                    'include_jquery' => false,
                ]
            )
            ->add('locationName', 'text', [
                'label' => 'Location Name'
            ])
            ->end()
        ->end();
        
        $show
            ->tab('Media')
            ->with(
                'General',
                [
                    'description' => 'This section contains connected media',
                    'class' => 'col-xs-12',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add(
                'media',
                'sonata_media_type',
                [
                    'provider' => 'sonata.media.provider.image',
                    'context' => 'default',
                    'required' => false,
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
            ->add('typeSkip')
            ->add('locationName');
    }

    /**
     * @param ListMapper $listMapper
     */
    public function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('dateIn')
            ->add('dateOut')
            ->add('typeSkip')
            ->add('status')
            ->add('owner')
            ->add('flagg')
            ->add('lastEdited')
            ->add('longitude', 'fishiriAggregate', [
                'aggregateName' => 'Location',
                'colspan' => 3,
                'label' => 'Longitude'
            ])
            ->add('latitude', 'fishiriAggregate', [
                'label' => 'Latitude'
            ])
            ->add('locationName', 'fishiriAggregate', [
                'label' => 'Location name'
            ])

            ->add('_action', 'actions', [
                'actions' => [
                    'delete' => [],
                    'edit' => [],
                ]
            ])
        ;
    }
}
