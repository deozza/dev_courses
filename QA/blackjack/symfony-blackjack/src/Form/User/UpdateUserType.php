<?php

namespace App\Form\User;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', TextType::class, [
            'constraints' => [
                new \Symfony\Component\Validator\Constraints\Email(),
                new \Symfony\Component\Validator\Constraints\Length(['max' => 255])
            ]
        ])
        ->add('password', PasswordType::class, [
            'constraints' => [
                new \Symfony\Component\Validator\Constraints\Length(['min' => 6, 'max' => 255])
            ]
        ])
        ->add('username', TextType::class, [
            'constraints' => [
                new \Symfony\Component\Validator\Constraints\Length(['min' => 3, 'max' => 255])
            ]
        ])
        ->add('wallet', NumberType::class, [
            'constraints' => [
                new \Symfony\Component\Validator\Constraints\GreaterThanOrEqual(0)
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_protection' => false,
        ]);
    }
}
