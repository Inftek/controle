<?php

namespace MRS\ControleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;

class TbFinancasType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     * Fix
     * 'years' =>range(date('Y'),date('Y')),
     * 'months' => range(date('m'),date('m')),
     * 'days' => range(date('d'),date('d'))
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('finDataCadastro','date',array('label' => 'Data'))
            ->add('finValor','money', array('currency' => 'BRL', 'scale' => 2,'label' => 'Valor'))
            ->add('finDescricao','text',array('label' => 'Descrição'))
            ->add('tenCodigo','entity', array('label'=> 'Tipo',
                                              'class' => 'MRSControleBundle:TbTipoEntrada',
                                              'placeholder' => false
                                             )
                )
            ->add('catCodigo','entity',array('label' => 'Categoria',
                                             'attr' => array('class' => 'select2'),
                                             'class' => 'MRS\ControleBundle\Entity\TbCategoria'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MRS\ControleBundle\Entity\TbFinancas'
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'mrs_controlebundle_tbfinancas';
    }
}
