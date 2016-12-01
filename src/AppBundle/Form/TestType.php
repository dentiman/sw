<?php

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Dentiman\BootstrapBundle\Form\Type\ColorPickerType;
use Dentiman\BootstrapBundle\Form\Type\DatePickerType;
use Dentiman\BootstrapBundle\Form\Type\MultiChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class TestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('min', 'dentiman_choice_range',['choice_options'=>array('choices' => array(
                'format' => 'rgb',
                'format2' => "yyyy-mm-dd"

            ))
            ]
            );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
        ));
    }
    public function getName()
    {
        return 'test_form';
    }
}