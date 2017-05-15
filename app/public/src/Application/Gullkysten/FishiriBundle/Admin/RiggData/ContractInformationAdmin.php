<?php

namespace Application\Gullkysten\FishiriBundle\Admin\RiggData;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class ContractInformationAdmin
 * @package Application\Gullkysten\FishiriBundle\Admin\RiggData
 */
class ContractInformationAdmin extends AbstractAdmin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with(
                'General',
                [
                    'description' => 'This section contains general info about the Rigg contract information',
                    'class' => 'col-xs-6',
                    'box_class' => 'box box-primary box-solid',
                ]
            )
            ->add('status', 'text', ['label' => 'Status'])
            ->add('operator', 'text', ['label' => 'Operator'])
            ->add(
                'contractStarted',
                'sonata_type_date_picker',
                [
                    'label' => 'Contract expires',
                    'pattern' => 'dd MMM y',
                ]
            )
            ->add(
                'contractExpires',
                'sonata_type_date_picker',
                [
                    'label' => 'Contract expires',
                    'pattern' => 'dd MMM y',
                ]
            )
            ->add('sector', 'text', ['label' => 'Sector'])
            ->add(
                'dayRate',
                'text',
                [
                    'label' => 'Day Rate (USD)'
                ]
            )
            ->add('comment', 'textarea', ['label' => 'Comment'])
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('status')
            ->add('contractStarted')
            ->add('contractExpires')
            ->add('sector')
            ->add(
                'dayRate',
                'currency',
                [
                    'label' => 'Day Rate',
                    'currency' => 'USD'
                ]
            )
            ->add('_action', 'actions', [
                'actions' => [
                    'delete' => [],
                    'edit' => [],
                ]
            ])
        ;
    }
}
