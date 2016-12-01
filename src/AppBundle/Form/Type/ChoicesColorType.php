<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Dentiman\BootstrapBundle\Form\Type\ColorPickerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChoicesColorType extends AbstractType
{
    public function getName()
    {
        return 'dentiman_choices_color';
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'dentiman_choices_color';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('color', HiddenType::class)
            ->add('choice',ChoiceType::class,array('label'=>$options['label'], 'choices' => $options['choices']))

        ;
    }



    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'compound' => true,
            'required' => false,
            'choices'            => array(),

        ));
    }

    public function getParent()
    {
        return TextType::class;
    }



}