<?php
namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsOnTheHourValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        // Directly return if the value is null
        if ($value === null) {
            return;
        }

        if (!$value instanceof \DateTimeInterface) {
            // If the value is not a DateTimeInterface, there's nothing to validate
            return;
        }

        $hour = (int) $value->format('H');
        $minute = (int) $value->format('i');

        if ($minute !== 0 || $hour < 8 || $hour > 18) {
            $this->context->buildViolation($constraint->message)
                          ->addViolation();
        }
    }
}
