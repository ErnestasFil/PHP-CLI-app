<?php

class StringRule implements Rule
{
    public function passes($value): bool
    {
        return is_string($value);
    }

    public function message(): string
    {
        return 'The :attribute must be a string.';
    }
}