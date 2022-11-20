<?php

namespace Baubyte\Validation;

use Baubyte\Validation\Rules\Email;
use Baubyte\Validation\Rules\Required;
use Baubyte\Validation\Rules\RequiredWith;
use Baubyte\Validation\Rules\ValidationRule;

class Rule {
    /**
     * Undocumented function
     *
     * @return ValidationRule
     */
    public function email(): ValidationRule {
        return new Email();
    }

    public static function required(): ValidationRule {
        return new Required();
    }

    public static function requiredWith(string $withField): ValidationRule {
        return new RequiredWith($withField);
    }
}
