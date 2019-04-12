<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options' => array('label' => 'Mot de Passe', 'attr' => ['placeholder' => 'Mot de passe', 'name' => '_password']),
                'second_options' => array('label' => 'Confirmation', 'attr' => ['placeholder' => 'Confirmation du mot de passe']),
            ))
            ->add('phone')
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Journaliste' => 'ROLE_USER',
                    'Leader' => 'ROLE_LEADER',
                    'Administrateur' => 'ROLE_ADMIN'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
