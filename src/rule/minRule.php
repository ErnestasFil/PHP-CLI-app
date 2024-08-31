<?php

class MinRule implements Rule
{
    protected int $min;
    protected string $type;

    public function __construct(string $type, int $min)
    {
        $this->type = $type;
        $this->min = $min;
    }

    public function passes(mixed $value): bool
    {
        if ($value === null) return false;
        return match ($this->type) {
            "str" => strlen($value) >= $this->min,
            "num" => $value >= $this->min,
            default => false
        };
    }

    public function message(): string
    {
        return match ($this->type) {
            "str" => "The :attribute must be at least $this->min characters.",
            "num" => "The :attribute must be at least $this->min.",
            "default" => "The :attribute is invalid."
        };
    }
}
