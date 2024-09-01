<?php

abstract class BaseState implements State
{
    protected array $lines = [];
    protected array $options = [];
    protected array $tableData = [];
    protected array $tableHeader = [];
    protected int $selectedIndex = 0;
    protected string $color;
    protected BaseState $backState;

    public function handleInput(): BaseState|bool
    {
        $navigationControl = false;
        while (!$navigationControl) {
            $input = ConsoleInput::getInput();
            $navigationControl = match ($input) {
                "up" => $this->moveUp(),
                "down" => $this->moveDown(),
                "enter" => $this->selectOption(),
                default => null,
            };
        }
        return $navigationControl;
    }

    protected function moveUp(): bool
    {
        if ($this->selectedIndex > 0) {
            $this->selectedIndex--;
            return true;
        }
        return false;
    }

    protected function moveDown(): bool
    {
        if ($this->selectedIndex < count($this->options) - 1) {
            $this->selectedIndex++;
            return true;
        }
        return false;
    }

    protected function selectOption(): BaseState
    {
        $keys = array_keys($this->options);
        $selectedOption = $keys[$this->selectedIndex];
        return $this->createState($selectedOption);
    }

    protected function createState(string $selectedOption): BaseState
    {
        return $this->options[$selectedOption];
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getTableData(): array
    {
        return $this->tableData;
    }

    public function getTableHeader(): array
    {
        return $this->tableHeader;
    }

    public function getSelectedIndex(): int
    {
        return $this->selectedIndex;
    }

    public function getColor(): string
    {
        return $this->color;
    }
}
