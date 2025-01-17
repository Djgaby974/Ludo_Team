<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: GameRepository::class)]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ORM\DiscriminatorMap([
    'board' => BoardGame::class, 
    'card' => CardGame::class, 
    'duel' => DuelGame::class
])]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['game_details', 'event_games'])]
    #[Assert\NotBlank(message: "Le nom du jeu est obligatoire")]
    #[Assert\Length(
        min: 2, 
        max: 100, 
        minMessage: "Le nom du jeu doit contenir au moins {{ limit }} caractères", 
        maxMessage: "Le nom du jeu ne peut pas dépasser {{ limit }} caractères"
    )]
    private ?string $name = null;

    #[ORM\Column]
    #[Groups(['game_details'])]
    #[Assert\NotBlank(message: "Le nombre maximum de participants est obligatoire")]
    #[Assert\Positive(message: "Le nombre maximum de participants doit être positif")]
    #[Assert\Range(
        min: 2, 
        max: 20, 
        notInRangeMessage: "Le nombre de participants doit être entre {{ min }} et {{ max }}"
    )]
    private ?int $maxParticipants = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getMaxParticipants(): ?int
    {
        return $this->maxParticipants;
    }

    public function setMaxParticipants(int $maxParticipants): static
    {
        $this->maxParticipants = $maxParticipants;

        return $this;
    }
}
