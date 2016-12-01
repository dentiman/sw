<?php

namespace AppBundle\Form;



use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiltersCheckboxesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $filterManager = $options['filter_manager'];
        foreach ($filterManager->getFiltersFormFields() as $groupName => $groupFilters) {

            $newFormGroup = $builder->create('gr_' . $groupName, 'tab', array(
                'label' => 'gr_' . $groupName,
                'inherit_data' => true,
            ));

            foreach ($groupFilters as $filters) {

                $fieldOptions = ['label'=>$filters['id'],'required' => false];

                $newFormGroup->add(
                    $filters['id'],
                    CheckboxType::class,
                    $fieldOptions
                );
            }
            $builder->add($newFormGroup);
        }

    }

    public function configureOptions(OptionsResolver $resolver)
    {
       $resolver->setRequired('filter_manager');
    }

    public function getName()
    {
        return 'filters_checkboxes';
    }
}
