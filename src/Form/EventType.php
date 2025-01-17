<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Game;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de l\'événement',
                'attr' => [
                    'placeholder' => 'Entrez un nom pour votre événement'
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le nom de l\'événement est obligatoire']),
                    new Assert\Length([
                        'min' => 3,
                        'max' => 100,
                        'minMessage' => 'Le nom de l\'événement doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Le nom de l\'événement ne peut pas dépasser {{ limit }} caractères'
                    ])
                ]
            ])
            ->add('dateEvent', DateTimeType::class, [
                'label' => 'Date de l\'événement',
                'widget' => 'single_text',
                'required' => true,
                'constraints' => [
                    new Assert\NotNull(['message' => 'La date de l\'événement est obligatoire']),
                    new Assert\GreaterThan([
                        'value' => 'now',
                        'message' => 'La date de l\'événement doit être dans le futur'
                    ]),
                    new Assert\LessThan([
                        'value' => '+1 year',
                        'message' => 'La date de l\'événement ne peut pas être plus d\'un an dans le futur'
                    ])
                ]
            ])
            ->add('location', TextType::class, [
                'label' => 'Lieu de l\'événement',
                'attr' => [
                    'placeholder' => 'Entrez le lieu de votre événement'
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le lieu de l\'événement est obligatoire']),
                    new Assert\Length([
                        'min' => 3,
                        'max' => 100,
                        'minMessage' => 'Le lieu de l\'événement doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Le lieu de l\'événement ne peut pas dépasser {{ limit }} caractères'
                    ])
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description de l\'événement',
                'attr' => [
                    'placeholder' => 'Décrivez votre événement en quelques mots...',
                    'rows' => 4
                ],
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 500,
                        'maxMessage' => 'La description ne peut pas dépasser {{ limit }} caractères'
                    ])
                ]
            ])
            ->add('maxParticipants', IntegerType::class, [
                'label' => 'Nombre maximum de participants',
                'attr' => [
                    'min' => 2,
                    'max' => 20,
                    'placeholder' => 'Nombre de participants'
                ],
                'constraints' => [
                    new Assert\NotNull(['message' => 'Le nombre de participants est obligatoire']),
                    new Assert\Range([
                        'min' => 2,
                        'max' => 20,
                        'notInRangeMessage' => 'Le nombre de participants doit être entre {{ min }} et {{ max }}'
                    ])
                ]
            ])
            ->add('games', EntityType::class, [
                'label' => 'Jeux',
                'class' => Game::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'constraints' => [
                    new Assert\Count([
                        'min' => 1,
                        'max' => 3,
                        'minMessage' => 'Vous devez sélectionner au moins {{ limit }} jeu',
                        'maxMessage' => 'Vous ne pouvez pas sélectionner plus de {{ limit }} jeux'
                    ])
                ]
            ])
            ->add('participants', EntityType::class, [
                'label' => 'Participants',
                'class' => User::class,
                'choice_label' => function(User $user) {
                    return $user->getPrenom() ?: 'Utilisateur sans prénom';
                },
                'multiple' => true,
                'expanded' => false,
                'required' => false,
                'attr' => [
                    'class' => 'select2',
                    'data-placeholder' => 'Sélectionnez les participants'
                ]
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
