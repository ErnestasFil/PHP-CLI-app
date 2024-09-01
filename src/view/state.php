<?php

interface State
{
    public function display(): void;

    public function handleInput();

    public function getOptions(): array;

    public function getTableHeader(): array;

    public function getTableData(): array;

    public function __init(): void;
}
