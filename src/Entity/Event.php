<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['event_details'])]
    #[Assert\NotNull(message: "L'organisateur de l'événement est obligatoire")]
    private ?User $organisateur = null;

    #[ORM\ManyToMany(targetEntity: User::class)]
    #[ORM\JoinTable(name: 'event_participants')]
    #[Groups(['event_participants'])]
    #[Assert\Count(
        min: 2, 
        max: 10, 
        minMessage: "Un événement doit avoir au moins {{ limit }} participants", 
        maxMessage: "Un événement ne peut pas avoir plus de {{ limit }} participants"
    )]
    private Collection $participants;

    #[ORM\ManyToMany(targetEntity: Game::class)]
    #[Groups(['event_games'])]
    #[Assert\Count(
        min: 1, 
        max: 3, 
        minMessage: "Un événement doit avoir au moins {{ limit }} jeu", 
        maxMessage: "Un événement ne peut pas avoir plus de {{ limit }} jeux"
    )]
    private Collection $games;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['event_details'])]
    #[Assert\NotNull(message: "La date de l'événement est obligatoire")]
    #[Assert\GreaterThan('now', message: "La date de l'événement doit être dans le futur")]
    #[Assert\LessThan('+1 year', message: "La date de l'événement ne peut pas être plus d'un an dans le futur")]
    private ?\DateTimeInterface $dateEvent = null;

    #[ORM\Column(length: 500, nullable: true)]
    #[Assert\Length(
        min: 10, 
        max: 500, 
        minMessage: "La description de l'événement doit contenir au moins {{ limit }} caractères", 
        maxMessage: "La description de l'événement ne peut pas dépasser {{ limit }} caractères"
    )]
    #[Groups(['event_details'])]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Groups(['event_details'])]
    #[Assert\NotBlank(message: "Le lieu de l'événement est obligatoire")]
    #[Assert\Length(
        min: 3, 
        max: 100, 
        minMessage: "Le lieu de l'événement doit contenir au moins {{ limit }} caractères", 
        maxMessage: "Le lieu de l'événement ne peut pas dépasser {{ limit }} caractères"
    )]
    private ?string $location = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(['event_details'])]
    #[Assert\Length(
        min: 3, 
        max: 100, 
        minMessage: "Le lieu doit contenir au moins {{ limit }} caractères", 
        maxMessage: "Le lieu ne peut pas dépasser {{ limit }} caractères"
    )]
    private ?string $lieu = null;

    #[ORM\Column(length: 255)]
    #[Groups(['event_details'])]
    #[Assert\NotBlank(message: "Le nom de l'événement est obligatoire")]
    #[Assert\Length(
        min: 3, 
        max: 100, 
        minMessage: "Le nom de l'événement doit contenir au moins {{ limit }} caractères", 
        maxMessage: "Le nom de l'événement ne peut pas dépasser {{ limit }} caractères"
    )]
    private ?string $name = null;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
        $this->games = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrganisateur(): ?User
    {
        return $this->organisateur;
    }

    public function setOrganisateur(?User $organisateur): static
    {
        $this->organisateur = $organisateur;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(User $participant): static
    {
        if (!$this->participants->contains($participant)) {
            $this->participants->add($participant);
        }

        return $this;
    }

    public function removeParticipant(User $participant): static
    {
        $this->participants->removeElement($participant);

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): static
    {
        if (!$this->games->contains($game)) {
            $this->games->add($game);
        }

        return $this;
    }

    public function removeGame(Game $game): static
    {
        $this->games->removeElement($game);

        return $this;
    }

    public function getDateEvent(): ?\DateTimeInterface
    {
        return $this->dateEvent;
    }

    public function setDateEvent(\DateTimeInterface $dateEvent): static
    {
        $this->dateEvent = $dateEvent;

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

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function setLieu(?string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
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
}
