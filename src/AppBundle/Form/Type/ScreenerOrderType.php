<?php

namespace AppBundle\Form\Type;

use AppBundle\Service\FiltersManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ScreenerOrderType extends AbstractType
{
    public $fm;
    /**
     * ScreenerOrderType constructor.
     */
    public function __construct(FiltersManager $filtersManager)
    {
        $this->fm = $filtersManager;
    }

    public function getName()
    {
        return 'order_range_type';
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'order_range_type';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {



        $OrderChoices = [];

        foreach ($this->fm->filterInfo as $key => $value) {
            $OrderChoices[$key] = $key;
        }

        $childOptions = array_merge($options['range_options'],array('choices'=>$OrderChoices,'placeholder' => 'Change %'));

        $ascOptions = array_merge($options['range_options'],array('choices'=>array('DESC'=>'','ASC'=>'1')));
        $builder
            ->add('order', ChoiceType::class,$childOptions)
            ->add('asc', ChoiceType::class,$ascOptions)
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
                'range_options'         => array(
                'required' => false,
                'label'=> false,
                'attr' => ['style'=>'width:50%']
            ),

        ));
    }

    public function getParent()
    {
        return TextType::class;
    }



}