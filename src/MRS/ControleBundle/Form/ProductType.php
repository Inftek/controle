<?php

namespace MRS\ControleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image_file',FileType::class,array('label'=>'File'))
            ->add('updatedAt',null,array('label'=>'Atualizado Em'))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MRS\ControleBundle\Entity\Product'
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'mrs_controlebundle_product';
    }
}
