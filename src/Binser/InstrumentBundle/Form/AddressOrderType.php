<?php

namespace Binser\InstrumentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressOrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('region', null, array(
                'attr' => array(
                    'placeholder' => 'Московская область',
                    'class' => 'region_input'
                ),
                'label' => 'Регион или Страна'))
            ->add('city', null, array(
                'attr' => array(
                    'placeholder' => 'Москва',
                    'class' => 'city_input'
                ),
                'label' => 'Населенный пункт'))
            ->add('district', null, array(
                'attr' => array(
                    'placeholder' => 'ЦАО',
                    'class' => 'district_input'
                ),
                'label' => 'Район или округ'))
            ->add('street', null, array(
                'attr' => array(
                    'placeholder' => 'Ленинский проспет',
                    'class' => 'input_block'
                ),
                'label' => 'Улица, переулок или проспект'))
            ->add('house', null, array(
                'attr' => array(
                    'placeholder' => '101',
                    'class' => 'input_block'
                ),
                'label' => 'Дом'))
            ->add('flat', null, array(
                'required' => false,
                'attr' => array(
                    'placeholder' => '49',
                    'class' => 'input_block'
                ),
                'label' => 'Квартира'))
            ->add('enterCode', null, array(
                'attr' => array(
                    'placeholder' => '1010',
                    'class' => 'input_block'
                ),
                'label' => 'Домофон'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Binser\InstrumentBundle\Entity\AddressOrder',
            'csrf_protection' => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'AddressOrder';
    }
}