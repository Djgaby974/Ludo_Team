<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Game;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de l\'événement',
                'attr' => [
                    'placeholder' => 'Entrez un nom pour votre événement'
                ]
            ])
            ->add('dateEvent', DateTimeType::class, [
                'label' => 'Date de l\'événement',
                'widget' => 'single_text',
                'required' => true
            ])
            ->add('location', TextType::class, [
                'label' => 'Lieu de l\'événement',
                'attr' => [
                    'placeholder' => 'Entrez le lieu de votre événement'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description de l\'événement',
                'attr' => [
                    'placeholder' => 'Décrivez votre événement en quelques mots...',
                    'rows' => 4
                ],
                'required' => false
            ])
            ->add('games', EntityType::class, [
                'label' => 'Jeux',
                'class' => Game::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('participants', EntityType::class, [
                'label' => 'Participants',
                'class' => User::class,
                'choice_label' => 'prenom',
                'multiple' => true,
                'expanded' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
