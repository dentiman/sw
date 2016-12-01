<?php

namespace AppBundle\Form;


use AppBundle\Form\Choices\FilterChoices;
use Dentiman\BootstrapBundle\Form\Type\DateRangePickerType;
use Dentiman\BootstrapBundle\Form\Type\MultiChoiceType;
use AppBundle\Form\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Form\Type\ScreenerOrderType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScreenerFiltersDataType extends AbstractType
{

    public $formTypes = [
        null,
        RangeType::class,
        ChoiceType::class,
        MultiChoiceType::class,
        DateRangePickerType::class,
       TextType::class,
        TextType::class,
       ChoiceType::class,
        ChoiceType::class,
        ScreenerOrderType::class,
        ChoiceType::class,
        ChoiceType::class,
        MultiChoiceType::class,
        ChoiceType::class,
    ];

    public $choises = FilterChoices::CHOICES;


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

                if ($filters['choices'] != '') {
                    $fieldOptions['choices'] = $this->choises[$filters['choices']];
                }

                $newFormGroup->add(
                    $filters['id'],
                    $this->formTypes[$filters['operator']],
                    $fieldOptions
                );

            }
            $builder
                ->add($newFormGroup);
        }

    }

    public function configureOptions(OptionsResolver $resolver)
    {
       $resolver->setRequired('filter_manager');
    }


    public function getName()
    {
        return 'filters_data';
    }
}
