<?php

namespace MRS\ControleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class TbFinancasType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('finDataCadastro','date',array('label' => 'Data',
                  'years' =>range(date('Y'),date('Y')),
                  'months' => range(date('m'),date('m')),
                  'days' => range(date('d'),date('d'))))
            ->add('finValor','money', array('currency' => 'BRL', 'scale' => 2,'label' => 'Valor'))
            ->add('finDescricao','text',array('label' => 'Descrição'))
            ->add('tenCodigo','entity', array('label'=> 'Tipo',
                                              'class' => 'MRSControleBundle:TbTipoEntrada',
                                              'placeholder' => false
                                             )
                )
            ->add('catCodigo','entity',array('label' => 'Categoria','class' => 'MRS\ControleBundle\Entity\TbCategoria'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MRS\ControleBundle\Entity\TbFinancas'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mrs_controlebundle_tbfinancas';
    }
}
