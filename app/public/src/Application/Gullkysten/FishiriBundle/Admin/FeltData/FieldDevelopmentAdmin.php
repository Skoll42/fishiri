<?php

namespace Application\Gullkysten\FishiriBundle\Admin\FeltData;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class FieldDevelopmentAdmin
 * @package Application\Gullkysten\FishiriBundle\Admin\FeltData
 */
class FieldDevelopmentAdmin extends AbstractAdmin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('productionStructure', 'text', ['label' => 'Production structure'])
            ->add('productionDrillingQuarters', 'text', ['label' => 'Production drilling quarters'])
            ->add('material', 'text', ['label' => 'Material'])
            ->add('additionalInfo', 'text', ['label' => 'Additional info'])
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('productionStructure')
            ->add('productionDrillingQuarters')
            ->add('material')
            ->add('additionalInfo')

            ->add('_action', 'actions', [
                'actions' => [
                    'delete' => [],
                    'edit' => [],
                ]
            ])
        ;
    }
}
