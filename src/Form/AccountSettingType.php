<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountSettingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name',
                'attr'  => ['placeholder' => 'Enter Your Name']
            ])
            ->add('email', TextType::class, [
                'label' => 'Email',
                'attr'  => ['placeholder' => 'Enter Your Email']
            ])
            ->add('phone', TextType::class, [
                'label' => 'Phone',
                'attr'  => ['placeholder' => 'Enter Your Phone']
            ])
            ->add('location', TextType::class, [
                'label' => 'Location',
                'attr'  => ['placeholder' => 'Enter Your Location']
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Save Changes'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // 'data' => null, // si quieres por defecto
            // Define el array como data_class => null para no forzar una entidad
            'data_class' => null,
            'session' => null,  // Para poder pasar la sesión en las opciones
        ]);
    }
}
