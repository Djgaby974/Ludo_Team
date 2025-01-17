<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\BoardGame;
use App\Entity\CardGame;
use App\Entity\DuelGame;
use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Création des utilisateurs
        $users = [];
        $userNames = ['Alice', 'Bob', 'Charlie', 'David', 'Eve'];
        foreach ($userNames as $name) {
            $user = new User();
            $user->setEmail(strtolower($name) . '@ludoteam.com');
            $user->setPrenom($name);
            
            // Hachage du mot de passe
            $hashedPassword = $this->passwordHasher->hashPassword($user, 'password123');
            $user->setPassword($hashedPassword);
            
            $manager->persist($user);
            $users[] = $user;
        }

        // Création des jeux
        $boardGames = [
            ['Catan', 4],
            ['Carcassonne', 5],
            ['Pandemic', 4]
        ];

        $cardGames = [
            ['Uno', 10],
            ['Magic: The Gathering', 2],
            ['Exploding Kittens', 5]
        ];

        $duelGames = [
            ['Chess', 2],
            ['Mortal Kombat', 2],
            ['Tekken', 2]
        ];

        $games = [];

        foreach ($boardGames as [$name, $maxParticipants]) {
            $game = new BoardGame();
            $game->setName($name);
            $game->setMaxParticipants($maxParticipants);
            $manager->persist($game);
            $games[] = $game;
        }

        foreach ($cardGames as [$name, $maxParticipants]) {
            $game = new CardGame();
            $game->setName($name);
            $game->setMaxParticipants($maxParticipants);
            $manager->persist($game);
            $games[] = $game;
        }

        foreach ($duelGames as [$name, $maxParticipants]) {
            $game = new DuelGame();
            $game->setName($name);
            $game->setMaxParticipants($maxParticipants);
            $manager->persist($game);
            $games[] = $game;
        }

        // Création des événements
        $events = [];
        for ($i = 0; $i < 5; $i++) {
            $event = new Event();
            $event->setDateEvent(new \DateTime('+' . ($i + 1) . ' weeks'));
            $event->setOrganisateur($users[array_rand($users)]);
            
            // Ajouter des participants
            $participantCount = rand(2, 4);
            $eventParticipants = array_rand($users, $participantCount);
            foreach ($eventParticipants as $participantIndex) {
                $event->addParticipant($users[$participantIndex]);
            }

            // Ajouter des jeux
            $gameCount = rand(1, 3);
            $eventGames = array_rand($games, $gameCount);
            foreach ($eventGames as $gameIndex) {
                $event->addGame($games[$gameIndex]);
            }

            $manager->persist($event);
            $events[] = $event;
        }

        $manager->flush();
    }
}
