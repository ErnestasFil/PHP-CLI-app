<?php

class MaxRule implements Rule
{
    protected mixed $max;
    protected string $type;

    public function __construct(string $type, mixed $max)
    {
        $this->type = $type;
        if ($this->type === 'datetime') {
            $this->max = $max === "now" ? new DateTime(date('Y-m-d H:i:s')) : $max;
        } else {
            $this->max = $max;
        }
    }

    public function passes($value): bool
    {
        if ($value === null) return false;
        return match ($this->type) {
            "str" => strlen($value) <= (int)$this->max,
            "num" => $value <= $this->max,
            "datetime" => $this->validateDateTime($value),
            default => false
        };
    }

    protected function validateDateTime($value): bool
    {
        try {
            $valueDate = new DateTime($value);
        } catch (Exception $e) {
            return false;
        }
        return $valueDate <= $this->max;
    }

    public function message(): string
    {
        return match ($this->type) {
            "str" => "The :attribute must not be greater than $this->max characters.",
            "num" => "The :attribute must not be greater than $this->max.",
            "datetime" => "The :attribute must not be later than {$this->max->format('Y-m-d H:i:s')}.",
            "default" => "The :attribute is invalid."
        };
    }
}