<?php

interface Rule
{
    public function passes(mixed $value): bool;

    public function message(): string;
}