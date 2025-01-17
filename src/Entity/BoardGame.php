<?php

namespace App\Entity;

use App\Repository\BoardGameRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BoardGameRepository::class)]
class BoardGame extends Game
{
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $complexity = null;

    public function getComplexity(): ?string
    {
        return $this->complexity;
    }

    public function setComplexity(?string $complexity): static
    {
        $this->complexity = $complexity;

        return $this;
    }

    public function getGameType(): string
    {
        return 'board';
    }
}
