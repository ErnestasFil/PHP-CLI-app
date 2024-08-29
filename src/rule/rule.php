<?php

interface Rule
{
    public function passes($value): bool;

    public function message(): string;
}