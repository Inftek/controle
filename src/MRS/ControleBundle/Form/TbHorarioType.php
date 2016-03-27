<?php

namespace MRS\ControleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TbHorarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('horDiaSemana')
            ->add('horData')
            ->add('horEntrada')
            ->add('horAlmocoIda')
            ->add('horAlmocoVolta')
            ->add('horSaida')
            ->add('horJustificativa')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MRS\ControleBundle\Entity\TbHorario'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mrs_controlebundle_tbhorario';
    }
}
