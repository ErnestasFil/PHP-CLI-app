<?php

class EmailRule implements Rule
{
    public function passes(mixed $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function message(): string
    {
        return "The :attribute must be a valid email address.";
    }
}