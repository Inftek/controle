<?php

namespace MRS\ControleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MRS\ControleBundle\Entity\TbHorario'
        ));
    }

//    /**
//     * @param OptionsResolverInterface $resolver
//     */
//    public function setDefaultOptions(OptionsResolverInterface $resolver)
//    {
//
//    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mrs_controlebundle_tbhorario';
    }
}
