<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Dentiman\BootstrapBundle\Form\Type\ColorPickerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CheckboxColorType extends AbstractType
{
    public function getName()
    {
        return 'dentiman_checkbox_color';
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'dentiman_checkbox_color';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('check', CheckboxType::class,array('label'=>$options['label'], 'widget_type' => 'inline-btn',
                'attr'  => array('class' => 'btn btn-default', 'style' => 'width:100%'  )))
            ->add('color', HiddenType::class)
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

        ));
    }

    public function getParent()
    {
        return TextType::class;
    }



}