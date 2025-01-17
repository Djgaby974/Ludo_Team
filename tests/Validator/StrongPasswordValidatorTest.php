<?php

namespace App\Tests\Validator;

use App\Validator\Constraints\StrongPassword;
use App\Validator\Constraints\StrongPasswordValidator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidatorInterface;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class StrongPasswordValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator(): ConstraintValidatorInterface
    {
        return new StrongPasswordValidator();
    }

    public function testNullIsValid()
    {
        $this->validator->validate(null, new StrongPassword());
        $this->assertNoViolation();
    }

    public function testEmptyStringIsInvalid()
    {
        $constraint = new StrongPassword();
        $this->validator->validate('', $constraint);
        $this->buildViolation($constraint->messageLength)
            ->setParameter('{{ min }}', 8)
            ->assertRaised();
    }

    public function testPasswordTooShortIsInvalid()
    {
        $constraint = new StrongPassword();
        $this->validator->validate('short', $constraint);
        $this->buildViolation($constraint->messageLength)
            ->setParameter('{{ min }}', 8)
            ->assertRaised();
    }

    public function testPasswordWithoutUppercaseIsInvalid()
    {
        $constraint = new StrongPassword();
        $this->validator->validate('password123!', $constraint);
        $this->buildViolation($constraint->messageUppercase)
            ->assertRaised();
    }

    public function testPasswordWithoutLowercaseIsInvalid()
    {
        $constraint = new StrongPassword();
        $this->validator->validate('PASSWORD123!', $constraint);
        $this->buildViolation($constraint->messageLowercase)
            ->assertRaised();
    }

    public function testPasswordWithoutNumberIsInvalid()
    {
        $constraint = new StrongPassword();
        $this->validator->validate('Password!', $constraint);
        $this->buildViolation($constraint->messageNumber)
            ->assertRaised();
    }

    public function testPasswordWithoutSpecialCharIsInvalid()
    {
        $constraint = new StrongPassword();
        $this->validator->validate('Password123', $constraint);
        $this->buildViolation($constraint->messageSpecial)
            ->assertRaised();
    }

    public function testValidStrongPassword()
    {
        $constraint = new StrongPassword();
        $this->validator->validate('Password123!', $constraint);
        $this->assertNoViolation();
    }
}
