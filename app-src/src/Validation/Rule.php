<?php

namespace Baubyte\Validation;

use Baubyte\Validation\Exceptions\RuleParseException;
use Baubyte\Validation\Exceptions\UnknownRuleException;
use Baubyte\Validation\Rules\Email;
use Baubyte\Validation\Rules\LessThan;
use Baubyte\Validation\Rules\Nullable;
use Baubyte\Validation\Rules\Number;
use Baubyte\Validation\Rules\Required;
use Baubyte\Validation\Rules\RequiredWhen;
use Baubyte\Validation\Rules\RequiredWith;
use Baubyte\Validation\Rules\ValidationRule;

class Rule {
    
    /**
     * Rule container. Maps rule name to rule class.
     *
     * @var array
     */
    private static array $rules = [];

    /**
     * Baubyte validation rules.
     *
     * @var array
     */
    private static array $defaultRules = [
        Required::class,
        RequiredWith::class,
        RequiredWhen::class,
        Nullable::class,
        Email::class,
        Number::class,
        LessThan::class,
    ];

    /**
     * Default Lune validation rules.
     *
     * @return void
     */
    public static function loadDefaultRules()
    {
        self::load(self::$defaultRules);
    }

    /**
     * Initialize rules.
     *
     * @param array $rules
     * @return void
     */
    public static function load(array $rules)
    {
        foreach ($rules as $class) {
            $className = array_slice(explode("\\", $class), -1)[0];
            $ruleName = snake_case($className);
            self::$rules[$ruleName] = $class;
        }
    }
    /**
     * Valid if field is valid email.
     *
     * @return ValidationRule
     */
    public static function email(): ValidationRule {
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
     * Valid that the field is less than
     *
     * @param float $lessThan
     * @return ValidationRule
     */
    public static function lessThan(float $lessThan): ValidationRule {
        return new LessThan($lessThan);
    }

    /**
     * Create a new rule object from string format (example: "requiredWith:name").
     *
     * @param string $string
     * @return ValidationRule
     */
    public static function from(string $string): ValidationRule {
        if (strlen($string) === 0) {
            throw new RuleParseException("No se puede hacer un parse de una cadena vacía.");
        }
        $ruleParts = explode(":", $string);

        if (!array_key_exists($ruleParts[0], self::$rules)) {
            throw new UnknownRuleException("La {$ruleParts[0]} no se encuentra.");
        }
        if (count($ruleParts) === 1) {
            return self::parseBasicRule($ruleParts[0]);
        }
        [$ruleName, $params] = $ruleParts;
        return self::parseRuleWithParameters($ruleName, $params);
    }
}
