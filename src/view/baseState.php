<?php

abstract class BaseState implements State
{
    protected array $options = [];
    protected int $selectedIndex = 0;

    public function handleInput()
    {
        $input = CLI::getInput();
        switch ($input) {
            case 'up':
                $this->moveUp();
                break;
            case 'down':
                $this->moveDown();
                break;
            case 'enter':
                return $this->selectOption();
        }
        return null;
    }

    protected function moveUp(): void
    {
        if ($this->selectedIndex > 0) {
            $this->selectedIndex--;
        }
    }

    protected function moveDown(): void
    {
        if ($this->selectedIndex < count($this->options) - 1) {
            $this->selectedIndex++;
        }
    }

    protected function selectOption()
    {
        $keys = array_keys($this->options);
        $selectedOption = $keys[$this->selectedIndex];
        return $this->createState($selectedOption);
    }

    abstract protected function createState($selectedOption);

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getSelectedIndex(): int
    {
        return $this->selectedIndex;
    }
}
