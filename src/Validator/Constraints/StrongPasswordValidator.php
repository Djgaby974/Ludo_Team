<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class StrongPasswordValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof StrongPassword) {
            throw new UnexpectedTypeException($constraint, StrongPassword::class);
        }

        // Ne pas valider les valeurs nulles
        if (null === $value) {
            return;
        }

        // Valeur vide ou trop courte
        if ('' === $value || strlen($value) < $constraint->min) {
            $this->context->buildViolation($constraint->messageLength)
                ->setParameter('{{ min }}', $constraint->min)
                ->addViolation();
            return;
        }

        // Vérifier la présence de majuscules
        if (!preg_match('/[A-Z]/', $value)) {
            $this->context->buildViolation($constraint->messageUppercase)
                ->addViolation();
        }

        // Vérifier la présence de minuscules
        if (!preg_match('/[a-z]/', $value)) {
            $this->context->buildViolation($constraint->messageLowercase)
                ->addViolation();
        }

        // Vérifier la présence de chiffres
        if (!preg_match('/[0-9]/', $value)) {
            $this->context->buildViolation($constraint->messageNumber)
                ->addViolation();
        }

        // Vérifier la présence de caractères spéciaux
        if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $value)) {
            $this->context->buildViolation($constraint->messageSpecial)
                ->addViolation();
        }
    }
}
