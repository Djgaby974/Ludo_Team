<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\BoardGame;
use App\Entity\CardGame;
use App\Entity\DuelGame; // Added this line
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du jeu',
                'required' => true
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => false
            ])
            ->add('maxParticipants', IntegerType::class, [
                'label' => 'Nombre maximum de participants',
                'required' => true
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Type de jeu',
                'choices' => [
                    'Jeu de plateau' => 'board',
                    'Jeu de cartes' => 'card',
                    'Jeu de duel' => 'duel'
                ],
                'mapped' => false,
                'required' => true
            ]);

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $game = $event->getData();
            $form = $event->getForm();

            if ($game instanceof BoardGame) {
                $form->add('complexity', TextType::class, [
                    'label' => 'Niveau de complexité',
                    'required' => false
                ]);
            } elseif ($game instanceof CardGame) {
                $form->add('cardType', TextType::class, [
                    'label' => 'Type de cartes',
                    'required' => false
                ]);
            }
        });

        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
            $game = $event->getData();
            $form = $event->getForm();

            $type = $form->get('type')->getData();

            // Créer le bon type de jeu en fonction du type sélectionné
            switch ($type) {
                case 'board':
                    if (!$game instanceof BoardGame) {
                        $game = new BoardGame();
                        $game->setName($form->get('name')->getData());
                        $game->setMaxParticipants($form->get('maxParticipants')->getData());
                        $game->setComplexity($form->get('complexity')->getData());
                    }
                    break;
                case 'card':
                    if (!$game instanceof CardGame) {
                        $game = new CardGame();
                        $game->setName($form->get('name')->getData());
                        $game->setMaxParticipants($form->get('maxParticipants')->getData());
                        $game->setCardType($form->get('cardType')->getData());
                    }
                    break;
                case 'duel':
                    if (!$game instanceof DuelGame) {
                        $game = new DuelGame();
                        $game->setName($form->get('name')->getData());
                        $game->setMaxParticipants($form->get('maxParticipants')->getData());
                    }
                    break;
            }

            $event->setData($game);
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
