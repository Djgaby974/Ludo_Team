<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
class StrongPassword extends Constraint
{
    public $messageLength = 'Le mot de passe doit contenir au moins {{ min }} caractères.';
    public $messageUppercase = 'Le mot de passe doit contenir au moins une lettre majuscule.';
    public $messageLowercase = 'Le mot de passe doit contenir au moins une lettre minuscule.';
    public $messageNumber = 'Le mot de passe doit contenir au moins un chiffre.';
    public $messageSpecial = 'Le mot de passe doit contenir au moins un caractère spécial.';

    public $min = 8;

    public function getTargets()
    {
        return self::PROPERTY_CONSTRAINT;
    }
}
