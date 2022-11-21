<?php

namespace Baubyte\Validation;

use Baubyte\Validation\Exceptions\ValidationException;

class Validator {
    /**
     * Data to validate
     *
     * @var array
     */
    protected array $data;

    /**
     * Instantiate required Validator.
     *
     * @param array $data
     */
    public function __construct(array $data) {
        $this->data = $data;
    }

    /**
     * Get validated data.
     *
     * @param array $validationRules Rules to be applied.
     * @param array $messages Override default messages for specific rules.
     * @return array
     */
    public function validate(array $validationRules, array $messages = []): array {
        $validated = [];
        $errors = [];
        /**
         * Go through the rules that each field has
         */
        foreach ($validationRules as $field => $rules) {
            if (!is_array($rules)) {
                $rules = [$rules];
            }
            //Field errors under validation
            $fieldUnderValidationErrors = [];
            /**
             * Check if the field passes each validation rule
             */
            foreach ($rules as $rule) {
                if (!$rule->isValid($field, $this->data)) {
                    $message = $messages[$field][$rule::class] ?? $rule->message();
                    $fieldUnderValidationErrors[$rule::class] = $message;
                }
            }
            //Check if field has errors
            if (count($fieldUnderValidationErrors) > 0) {
                $errors[$field] = $fieldUnderValidationErrors;
            } else {
                $validated[$field] = $this->data[$field];
            }
        }
        if (count($errors) > 0) {
            throw new ValidationException($errors);
        }
        return $validated;
    }
}
