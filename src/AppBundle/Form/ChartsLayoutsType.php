<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChartsLayoutsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $nm = $builder->create('nm', 'form', array(

            'inherit_data' => true,
        ))
            ->add('name',TextType::class,array('label'=>'Layout name','horizontal_label_class'=>'col-lg-12'))
            ->add('tf1', ChoiceType::class, array(
                'label' => 'Timeframe 1',
                'horizontal_label_class'=>'col-sm-4',
                'choices' => array(
                    'Daily' => 'd',
                    'Weekly' => 'w',
                    '1 min' => '1',
                    '2 min' => '2',
                    '3 min' => '3',
                    '5 min' => '5',
                    '15 min' => '15',
                    '60 min' => '60'
                )
            ))->add('tf2', ChoiceType::class, array(
            'horizontal_label_class'=>'col-sm-4',
                'required'    => false,
            'label' => 'Timeframe 2',
            'choices' => array(
                'Don\'t use' => '',
                'Daily' => 'd',
                'Weekly' => 'w',
                '1 min' => '1',
                '2 min' => '2',
                '3 min' => '3',
                '5 min' => '5',
                '15 min' => '15',
                '60 min' => '60'
            )
        ))->add('tf3', ChoiceType::class, array(
                'horizontal_label_class'=>'col-sm-4',
                'required'    => false,
                'label' => 'Timeframe 3',
                'choices' => array(
                    'Don\'t use' => '',
                    'Daily' => 'd',
                    'Weekly' => 'w',
                    '1 min' => '1',
                    '2 min' => '2',
                    '3 min' => '3',
                    '5 min' => '5',
                    '15 min' => '15',
                    '60 min' => '60'
                )
            ));

        $chart1 = $builder->create('gr1', 'tab', array(
            'label' => 'Chart 1',
            'icon' => 'area-chart',
            'inherit_data' => true,
        ))->add('chart1',SingleChartSettingsType::class);

        $chart2 = $builder->create('gr2', 'tab', array(
            'label' => 'Chart 2',
            'icon' => 'area-chart',
            'inherit_data' => true,
        ))->add('chart2',SingleChartSettingsType::class);

        $chart3 = $builder->create('gr3', 'tab', array(
            'label' => 'Chart 3',
            'icon' => 'area-chart',
            'inherit_data' => true,
        ))->add('chart3',SingleChartSettingsType::class);


        $showColumns = $builder->create('gr4', 'tab', array(
            'label' => 'Columns',
            'icon' => 'area-chart',
            'inherit_data' => true,
        ))->add('displayColumns',FiltersCheckboxesType::class,['filter_manager' => $options['filter_manager']]);


        $tabs = $builder->create('tabs', 'form', array(
            'inherit_data' => true,
        ))
        ->add($chart1)->add($chart2)->add($chart3)->add($showColumns);

        $builder->add($nm)->add($tabs)->add('save', SubmitType::class, array('label' => 'Save','attr' =>(array('class'=>'btn-success'))));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Presets\Charts',
        ));

        $resolver->setRequired('filter_manager');
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'horizontal_label_class'=>'col-lg-4'
        ));
    }

    public function getName()
    {
        return 'app_bundle_charts_layouts_type';
    }
}
