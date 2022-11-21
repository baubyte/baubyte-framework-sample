<?php

namespace Baubyte\Validation\Rules;

class RequiredWhen implements ValidationRule
{
    /**
     * Field used for comparators.
     *
     * @var string
     */
    protected string $otherField;
    /**
     * Operator to use for the if statement.
     *
     * @var string
     */
    protected string $operator;
    /**
     * value to compare with using `$operator`.
     *
     * @var string
     */
    protected string $compareWith;

    /**
     * Instantiate required when rule.
     *
     * @param string $otherField
     * @param string $operator
     * @param string $compareWith
     */
    public function __construct(string $otherField,string $operator,string $compareWith) {
        $this->otherField = $otherField;
        $this->operator = $operator;
        $this->compareWith = $compareWith;
    }
    /**
     * @inheritDoc
     */
    public function message(): string {
        return "Este campo es obligatorio cuando {$this->otherField} {$this->operator} {$this->compareWith}";
    }

    /**
     * @inheritDoc
     */
    public function isValid(string $field, array $data): bool {
        $required=null;
        if (!array_key_exists($this->otherField, $data)) {
            return false;
        }
        switch ($this->operator) {
            case "=":
                $required = $data[$this->otherField] == $this->compareWith;
                break;
            case ">":
                $required = $data[$this->otherField] > floatval($this->compareWith);
                break;
            case "<":
                $required = $data[$this->otherField] < floatval($this->compareWith);
                break;
            case ">=":
                $required = $data[$this->otherField] >= floatval($this->compareWith);
                break;
            case "<=":
                $required = $data[$this->otherField] <= floatval($this->compareWith);
                break;
        }
        return !$required || (isset($data[$field]) && $data[$field] != "");
    }
}