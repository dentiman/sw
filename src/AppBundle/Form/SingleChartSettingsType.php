<?php

namespace AppBundle\Form;

use AppBundle\Form\Type\CheckboxColorType;
use AppBundle\Form\Type\ChoicesColorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Dentiman\BootstrapBundle\Form\Type\ColorPickerType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SingleChartSettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $chartSetings = $builder->create('area', 'tab', array(
            'label' => 'Chart Setting',
            'icon' => 'pencil',
            'inherit_data' => true,
        ));

        $chartSetings->add('w', ChoiceType::class, array(
            'horizontal_label_class'=>'col-sm-4',
            'label' => 'Charts width',
            'required'    => false,
            'choices' => array(
                '400' => '400',
                '500' => '500',
                '600' => '600',
                '700' => '700',
                '800' => '800',
                '900' => '900',
                '1000' => '1000',
                '1200' => '1200',
                '1400' => '1400',
                '1650' => '1650',
            )
        ))
            ->add('h', ChoiceType::class, array(
                'horizontal_label_class'=>'col-sm-4',
                'label' => 'Charts height',
                'required'    => false,
                'choices' => array(
                    '200' => '200',
                    '250' => '250',
                    '300' => '300',
                    '350' => '350',
                    '400' => '400',
                    '450' => '450',
                    '500' => '500',
                    '550' => '550',
                    '600' => '600',
                    '650' => '650'
                )
            ))
            ->add('vol_wdt', ChoiceType::class, array(
                'horizontal_label_class'=>'col-sm-4',
                'label' => 'Volume height',
                'required'    => false,
                'choices' => array(
                    '40' => '40',
                    '60' => '60',
                    '90' => '80',
                    '100' => '100',
                    '120' => '120',
                    '150' => '150',
                    '180' => '180',
                    '200' => '200',
                )
            ))
            ->add('bgcolor', ColorPickerType::class, array(
                'horizontal_label_class'=>'col-sm-4',
                'required'    => false,
                'label' => 'Background color',
                'pickerOptions' => array(
                    'format' => 'rgb'
                )
            ))
            ->add('setka', ColorPickerType::class, array(
                'horizontal_label_class'=>'col-sm-4',
                'required'    => false,
                'label' => 'Grid color',
                'pickerOptions' => array(
                    'format' => 'rgb'
                )
            ))
            ->add('prem', CheckboxType::class, array(
                'horizontal_label_class'=>'col-sm-4',
                'required'    => false,
                'label' => 'Show extended session',
                'widget_type' => 'inline-btn',
                'attr'  => array('class' => 'btn btn-default', 'style' => 'width:100%'  )

            ))
            ->add('voll', CheckboxType::class, array(
                'horizontal_label_class'=>'col-sm-4',
                'required'    => false,
                'label' => 'Separate volume area',
                'widget_type' => 'inline-btn',
                'attr'  => array('class' => 'btn btn-default', 'style' => 'width:100%'  )

            ))
            ->add('spy_on', CheckboxColorType::class, array(
                'horizontal_label_class'=>'col-sm-4',
                'required'    => false,
                'label' => 'SPY line',

            ));


        $barSetings = $builder->create('bars', 'tab', array(
            'horizontal_label_class'=>'col-sm-4',
            'label' => 'Bar Setting',
            'icon' => 'pencil',
            'inherit_data' => true,
        ));

        $barSetings
            ->add('type', ChoiceType::class, array(
                'horizontal_label_class'=>'col-sm-4',
                'required'    => false,
                'label' => 'Chart type',
                'choices' => array(
                    'candle' => 'candle',
                    'bar' => 'bar'
                )
            ))->add('barw', ChoiceType::class, array(
                'horizontal_label_class'=>'col-sm-4',
                'required'    => false,
                'label' => 'Candle body width, px',
                'choices' => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10' => '10',
                )
            ))->add('thick', ChoiceType::class, array(
                'horizontal_label_class'=>'col-sm-4',
                'required'    => false,
                'label' => 'Candlewick widht, px',
                'choices' => array(
                    '1' => '0',
                    '2' => '1',
                    '3' => '2',
                    '4' => '3',
                )
            ))->add('kontur', ChoiceType::class, array(
                'horizontal_label_class'=>'col-sm-4',
                'required'    => false,
                'label' => 'Candle body width, px',
                'choices' => array(
                    '3' => '1',
                    '4' => '15',
                    '5' => '2',
                    '7' => '3',
                    '9' => '4',
                    '11' => '5'
                )
            ))->add('vol_b_w', ChoiceType::class, array(
                'horizontal_label_class'=>'col-sm-4',
                'required'    => false,
                'label' => 'Volume bar width, px',
                'choices' => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10' => '10'
                )
            ))->add('colorup', ColorPickerType::class, array(
                'horizontal_label_class'=>'col-sm-4',
                'required'    => false,
                'label' => 'Candle body up',
                'pickerOptions' => array(
                    'format' => 'rgb'
                )
            ))->add('colordown', ColorPickerType::class, array(
                'horizontal_label_class'=>'col-sm-4',
                'required'    => false,
                'label' => 'Candle body down',
                'pickerOptions' => array(
                    'format' => 'rgb'
                )
            ))->add('fcolorup', ColorPickerType::class, array(
                'horizontal_label_class'=>'col-sm-4',
                'required'    => false,
                'label' => 'Candlewick up',
                'pickerOptions' => array(
                    'format' => 'rgb'
                )
            ))->add('fcolord', ColorPickerType::class, array(
                'horizontal_label_class'=>'col-sm-4',
                'required'    => false,
                'label' => 'Candlewick down',
                'pickerOptions' => array(
                    'format' => 'rgb'
                )
            ))->add('vol_c_u', ColorPickerType::class, array(
                'horizontal_label_class'=>'col-sm-4',
                'required'    => false,
                'label' => 'volume up',
                'pickerOptions' => array(
                    'format' => 'rgb'
                )
            ))->add('vol_c_d', ColorPickerType::class, array(
                'horizontal_label_class'=>'col-sm-4',
                'required'    => false,
                'label' => 'volume down',
                'pickerOptions' => array(
                    'format' => 'rgb'
                )
            ));

        $MASetings = $builder->create('ma', 'tab', array(
            'horizontal_label_class'=>'col-sm-4',
            'required'    => false,
            'label' => 'Moving averadges',
            'icon' => 'pencil',
            'inherit_data' => true,
        ))
            ->add('sma1', ChoicesColorType::class, array(
                'horizontal_label_class'=>'col-sm-4',
                'required'    => false,
            'label' => 'SMA 1',
            'choices' => array(
                'No' => null,
                '10' => '10',
                '13' => '13',
                '20' => '20',
                '50' => '50',
                '100' => '100',
                '200' => '200'
            )
        ))->add('sma2', ChoicesColorType::class, array(
                'horizontal_label_class'=>'col-sm-4',
                'required'    => false,
                'label' => 'SMA 2',
                'choices' => array(
                    'No' => null,
                    '10' => '10',
                    '13' => '13',
                    '20' => '20',
                    '50' => '50',
                    '100' => '100',
                    '200' => '200'
                )
            ))->add('sma3', ChoicesColorType::class, array(
                'horizontal_label_class'=>'col-sm-4',
                'required'    => false,
                'label' => 'SMA 3',
                'choices' => array(
                    'No' => null,
                    '10' => '10',
                    '13' => '13',
                    '20' => '20',
                    '50' => '50',
                    '100' => '100',
                    '200' => '200'
                )
            ))->add('ema1', ChoicesColorType::class, array(
                'horizontal_label_class'=>'col-sm-4',
                'required'    => false,
                'label' => 'EMA 1',
                'choices' => array(
                    'No' => null,
                    '10' => '10',
                    '13' => '13',
                    '20' => '20',
                    '50' => '50',
                    '100' => '100',
                    '200' => '200'
                )
            ))->add('ema2', ChoicesColorType::class, array(
                'horizontal_label_class'=>'col-sm-4',
                'required'    => false,
                'label' => 'EMA 2',
                'choices' => array(
                    'No' => null,
                    '10' => '10',
                    '13' => '13',
                    '20' => '20',
                    '50' => '50',
                    '100' => '100',
                    '200' => '200'
                )
            ))->add('ema3', ChoicesColorType::class, array(
                'horizontal_label_class'=>'col-sm-4',
                'required'    => false,
                'label' => 'EMA 3',
                'choices' => array(
                    'No' => null,
                    '10' => '10',
                    '13' => '13',
                    '20' => '20',
                    '50' => '50',
                    '100' => '100',
                    '200' => '200'
                )
            ))->add('mav', ChoiceType::class, array(
                'horizontal_label_class'=>'col-sm-4',
                'required'    => false,
                'label' => 'MA view',
                'choices' => array(
                    'Line' => '0',
                    'Value' => '1'
                )
            ))->add('mat', ChoiceType::class, array(
                'horizontal_label_class'=>'col-sm-4',
                'required'    => false,
                'label' => 'thick, px',
                'choices' => array(
                    '1' => '1',
                    '2' => '2'
                )
            ));

        $LineSetings = $builder->create('lines', 'tab', array(
            'label' => 'Lines',
            'icon' => 'pencil',
            'inherit_data' => true,
        ))->add('lines_op', CheckboxColorType::class, array(
            'label' => 'Open Line'
        ))->add('lines_hi', CheckboxColorType::class, array(
            'label' => 'High'
        ))->add('lines_lo', CheckboxColorType::class, array(
            'label' => 'Low'
        ))->add('lines_cl', CheckboxColorType::class, array(
            'label' => 'Close'
        ))->add('lines_last', CheckboxColorType::class, array(
            'label' => 'Last price'

        ))->add('lines_d', ChoiceType::class, array(
            'label' => 'Number of days',
            'required'    => false,
            'choices' => array(
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5'
            )
        ));

        $builder->add($chartSetings)->add($barSetings)->add($MASetings)->add($LineSetings);

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getName()
    {
        return 'app_bundle_single_chart_settings_type';
    }
}
