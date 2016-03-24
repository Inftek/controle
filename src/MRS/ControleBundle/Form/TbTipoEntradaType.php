<?php

namespace MRS\ControleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TbTipoEntradaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tenDescricao')
            ->add('tenAtivo')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MRS\ControleBundle\Entity\TbTipoEntrada'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mrs_controlebundle_tbtipoentrada';
    }
}
