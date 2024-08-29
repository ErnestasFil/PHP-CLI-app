<?php

class MaxRule implements Rule
{
    protected int $max;
    protected string $type;

    public function __construct($type, $max)
    {
        $this->type = $type;
        $this->max = $max;
    }

    public function passes($value): bool
    {
        if ($value === null) return false;
        return match ($this->type) {
            "str" => strlen($value) <= $this->max,
            "num" => $value <= $this->max,
            default => false
        };
    }

    public function message(): string
    {
        return match ($this->type) {
            "str" => "The :attribute must not be greater than $this->max characters.",
            "num" => "The :attribute must not be greater than $this->max.",
            "default" => "The :attribute is invalid."
        };
    }
}