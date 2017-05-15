<?php

namespace Application\Gullkysten\FishiriBundle\Admin\RiggData;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class RigInformationAdmin
 * @package Application\Gullkysten\FishiriBundle\Admin\RiggData
 */
class RigInformationAdmin extends AbstractAdmin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('vesselType', 'text', ['label' => 'Vessel type'])
            ->add('vesselDesign', 'text', ['label' => 'Vessel design'])
            ->add('constructionDate', 'text', ['label' => 'Construction date'])
            ->add('upgradeDate', 'text', ['label' => 'Upgrade date'])
            ->add('classification', 'text', ['label' => 'Classification'])
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('vesselType')
            ->add('vesselDesign')
            ->add('constructionDate')
            ->add('upgradeDate')
            ->add('classification')

            ->add('_action', 'actions', [
                'actions' => [
                    'delete' => [],
                    'edit' => [],
                ]
            ])
        ;
    }
}
