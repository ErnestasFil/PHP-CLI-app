<?php

class DateTimeRule implements Rule
{
    protected string $format;

    public function __construct()
    {
        $this->format = 'Y-m-d H:i:s';
    }

    public function passes($value): bool
    {
        $dateTime = DateTime::createFromFormat($this->format, $value);
        return $dateTime && $dateTime->format($this->format) === $value;
    }

    public function message(): string
    {
        return "The :attribute must be a valid date time in the format $this->format.";
    }
}