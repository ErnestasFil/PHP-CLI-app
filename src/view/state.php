<?php

interface State
{
    public function display(): void;

    public function handleInput();

    public function getOptions(): array;

    public function getSelectedIndex(): int;

    public function getTableHeader(): array;

    public function getTableData(): array;

    public function getColor(): string;
}
