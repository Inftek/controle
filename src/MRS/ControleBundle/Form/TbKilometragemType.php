<?php

namespace MRS\ControleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TbKilometragemType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('kiDescricao')
            ->add('kiKilometragem')
            ->add('kiDataInicial')
            ->add('kiDataAtual')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MRS\ControleBundle\Entity\TbKilometragem',
            'grupo_de_validacao' => array('create','update')
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mrs_controlebundle_tbkilometragem';
    }

}
