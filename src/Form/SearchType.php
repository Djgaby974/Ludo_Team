<?php

namespace App\Form;

use App\Entity\Game;
use App\Repository\GameRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    private $gameRepository;

    public function __construct(GameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateFrom', DateType::class, [
                'label' => 'Date de début',
                'widget' => 'single_text',
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('dateTo', DateType::class, [
                'label' => 'Date de fin',
                'widget' => 'single_text',
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('gameType', ChoiceType::class, [
                'label' => 'Type de jeu',
                'choices' => [
                    'Jeu de plateau' => 'board',
                    'Jeu de cartes' => 'card',
                    'Jeu de duel' => 'duel'
                ],
                'required' => false,
                'placeholder' => 'Tous types',
                'attr' => ['class' => 'form-control']
            ])
            ->add('minParticipants', IntegerType::class, [
                'label' => 'Nombre minimum de participants',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'min' => 2,
                    'max' => 10
                ]
            ])
            ->add('games', EntityType::class, [
                'label' => 'Jeux disponibles',
                'class' => Game::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                'query_builder' => function(GameRepository $repo) {
                    return $repo->createQueryBuilder('g')
                        ->orderBy('g.name', 'ASC');
                },
                'attr' => ['class' => 'game-checkboxes']
            ])
            ->add('gameName', TextType::class, [
                'label' => 'Nom du jeu',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Rechercher un jeu...'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }
}
