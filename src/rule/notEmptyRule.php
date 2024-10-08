<?php

class NotEmptyRule implements Rule
{
    public function passes(mixed $value): bool
    {
        return !empty($value);
    }

    public function message(): string
    {
        return "The :attribute field cannot be empty.";
    }
}
