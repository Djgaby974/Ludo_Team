<?php

namespace App\Entity;

use App\Repository\CardGameRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CardGameRepository::class)]
class CardGame extends Game
{
    #[ORM\Column(length: 100, nullable: true)]
    private ?string $cardType = null;

    public function getCardType(): ?string
    {
        return $this->cardType;
    }

    public function setCardType(?string $cardType): static
    {
        $this->cardType = $cardType;

        return $this;
    }

    public function getGameType(): string
    {
        return 'card';
    }
}
