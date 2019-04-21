<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('dateStart')
            ->add('dateEnd')
            ->add('category')
            ->add('place')
            ->add('address')
            ->add('nameContact')
            ->add('mailContact')
            ->add('phoneContact')
            ->add('comment')
            //->add('upload')
            ->add('upload', FileType::class, ['label' => 'Brochure (File)'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
