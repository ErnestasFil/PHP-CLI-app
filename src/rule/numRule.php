<?php

class NumRule implements Rule
{
    protected string $type;
    protected ?int $decimalPlaces;

    public function __construct(string $type, ?int $decimalPlaces = null)
    {
        $this->type = $type;
        $this->decimalPlaces = $decimalPlaces;
    }

    public function passes(mixed $value): bool
    {
        if (!is_numeric($value)) return false;
        return match ($this->type) {
            "integer" => $this->validateInteger($value),
            "double" => $this->validateDouble($value),
            default => false
        };
    }

    protected function validateInteger(mixed $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_INT) !== false;
    }

    protected function validateDouble(mixed $value): bool
    {
        if (filter_var($value, FILTER_VALIDATE_FLOAT) === false)
            return false;
        
        if ($this->decimalPlaces === null)
            return true;

        $decimalPart = explode('.', (string)$value)[1] ?? '';
        return strlen($decimalPart) <= $this->decimalPlaces;
    }

    public function message(): string
    {
        return match ($this->type) {
            "integer" => "The :attribute must be an integer.",
            "double" => $this->decimalPlaces !== null
                ? "The :attribute must be a double with up to {$this->decimalPlaces} decimal places."
                : "The :attribute must be a valid double.",
            default => "The :attribute is invalid."
        };
    }
}
