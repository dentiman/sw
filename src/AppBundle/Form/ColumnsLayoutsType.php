<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ColumnsLayoutsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         $builder->setAction($this->generateUrl('target_route'))
            ->add('name',TextType::class)
            ->add('data', FiltersCheckboxesType::class,['filter_manager' => $options['filter_manager']])
            ->add('save', SubmitType::class, array('label' => 'Save'));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Presets\Columns',
        ));

        $resolver->setRequired('filter_manager');
    }



    public function getName()
    {
        return 'columns_layouts_type';
    }
}
