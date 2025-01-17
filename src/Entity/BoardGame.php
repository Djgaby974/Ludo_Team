<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class BoardGame extends Game
{
    // Propriétés spécifiques aux jeux de plateau si nécessaire
}
