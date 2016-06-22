<?php

namespace MRS\ControleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TbKilometragemType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('kiDescricao',null,['label' => 'Descrição:'])
            ->add('kiKilometragem',null, ['label' => 'Kilometragem:'])
            ->add('kiDataInicial',null,['label' => 'Data Inicial:'])
            ->add('kiDataAtual',null,['label' => 'Data Atual:'])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'validation_group' => array('update','create'),
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'mrs_controlebundle_tbkilometragem';
    }

}
