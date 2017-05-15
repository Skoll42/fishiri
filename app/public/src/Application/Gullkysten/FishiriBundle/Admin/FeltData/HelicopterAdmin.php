<?php

namespace Application\Gullkysten\FishiriBundle\Admin\FeltData;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class HelicopterAdmin
 * @package Application\Gullkysten\FishiriBundle\Admin\FeltData
 */
class HelicopterAdmin extends AbstractAdmin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('flightService', 'text', ['label' => 'Flight service'])
            ->add('flightBase', 'text', ['label' => 'Flight base'])
            ->add('offshoreBased', 'text', ['label' => 'Offshore based'])
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('flightService')
            ->add('flightBase')
            ->add('offshoreBased')

            ->add('_action', 'actions', [
                'actions' => [
                    'delete' => [],
                    'edit' => [],
                ]
            ])
        ;
    }
}
