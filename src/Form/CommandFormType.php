<?php

namespace App\Form;

use App\Entity\Commande;
use App\Repository\TeamRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Users;
use App\Entity\Evenement;

class CommandFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('nameApplicant')
            //->add('dateRequest')
            ->add('observation')
            ->add('dateDelivery')
            ->add('dateDiffusion')
            ->add('users', EntityType::class, [
                'class' => Users::class,
                'choice_label'=>function (Users $users) {
                    foreach ($users->getTeam() as $user){
                        return  $users->getFirstname().' (Team '.$user->getName().') ';
                    }
                    }
                    ,
                'expanded'=>true,
                'multiple'=>true
            ])
            ->add('event', EntityType::class, [
                'class'=> Evenement::class,
                'choice_label'=>'title',
                'expanded'=>true,
                'multiple'=>false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
