<?php
abstract class BaseState implements State
{
    protected array $options = [];
    protected $selectedIndex = 0;

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
            case 'esc':
                return 'back';
        }
        return null;
    }

    protected function moveUp()
    {
        if ($this->selectedIndex > 0) {
            $this->selectedIndex--;
        }
    }

    protected function moveDown()
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

    public function getOptions()
    {
        return $this->options;
    }

    public function getSelectedIndex()
    {
        return $this->selectedIndex;
    }
    abstract protected function createState($selectedOption);
}
