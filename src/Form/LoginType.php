<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr'  => ['placeholder' => 'Enter Your Email']
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Contraseña',
                'attr'  => ['placeholder' => 'Enter Your Password']
            ])
            ->add('login', SubmitType::class, [
                'label' => 'Sign In'
            ]);
    }
}
