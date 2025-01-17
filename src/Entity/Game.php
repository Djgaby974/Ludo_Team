<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: GameRepository::class)]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ORM\DiscriminatorMap([
    'board' => BoardGame::class, 
    'card' => CardGame::class, 
    'duel' => DuelGame::class
])]
abstract class Game
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
    #[Assert\Regex(
        pattern: '/^[a-zA-ZÀ-ÿ0-9\s-]+$/',
        message: "Le nom du jeu contient des caractères non autorisés"
    )]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['game_details'])]
    #[Assert\Length(
        min: 10, 
        max: 500, 
        minMessage: "La description du jeu doit contenir au moins {{ limit }} caractères", 
        maxMessage: "La description du jeu ne peut pas dépasser {{ limit }} caractères"
    )]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['game_details'])]
    #[Assert\Length(
        max: 1000, 
        maxMessage: "Les règles ne peuvent pas dépasser {{ limit }} caractères"
    )]
    private ?string $rules = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getRules(): ?string
    {
        return $this->rules;
    }

    public function setRules(?string $rules): static
    {
        $this->rules = $rules;

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

    // Méthode abstraite pour le type de jeu
    abstract public function getGameType(): string;
}
