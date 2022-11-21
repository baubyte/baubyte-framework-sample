<?php

namespace Baubyte\Validation;

use Baubyte\Validation\Rules\Email;
use Baubyte\Validation\Rules\LessThan;
use Baubyte\Validation\Rules\Number;
use Baubyte\Validation\Rules\Required;
use Baubyte\Validation\Rules\RequiredWhen;
use Baubyte\Validation\Rules\RequiredWith;
use Baubyte\Validation\Rules\ValidationRule;

class Rule {
    /**
     * Valid if field is valid email.
     *
     * @return ValidationRule
     */
    public function email(): ValidationRule {
        return new Email();
    }

    /**
     * Validate field required.
     *
     * @return ValidationRule
     */
    public static function required(): ValidationRule {
        return new Required();
    }

    /**
     * Validate field to check when validating actual field
     *
     * @param string $withField
     * @return ValidationRule
     */
    public static function requiredWith(string $withField): ValidationRule {
        return new RequiredWith($withField);
    }

    /**
     * Validates the field when the other field meets the rule.
     *
     * @param string $otherField
     * @param string $operator
     * @param string $compareWith
     * @return ValidationRule
     */
    public static function requiredWhen(string $otherField, string $operator, string $compareWith): ValidationRule {
        return new RequiredWhen($otherField, $operator, $compareWith);
    }

    /**
     * Valid if the field is a valid number.
     *
     * @return ValidationRule
     */
    public static function number(): ValidationRule {
        return new Number();
    }

    /**
     * Valida que el campo sea menor a
     *
     * @param float $lessThan
     * @return ValidationRule
     */
    public static function lessThan(float $lessThan): ValidationRule {
        return new LessThan($lessThan);
    }
}
