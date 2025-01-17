<?php

namespace App\Entity;

use App\Repository\DuelGameRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DuelGameRepository::class)]
class DuelGame extends Game
{
    #[ORM\Column(length: 100, nullable: true)]
    private ?string $strategy = null;

    public function getStrategy(): ?string
    {
        return $this->strategy;
    }

    public function setStrategy(?string $strategy): static
    {
        $this->strategy = $strategy;

        return $this;
    }

    public function getGameType(): string
    {
        return 'duel';
    }
}
