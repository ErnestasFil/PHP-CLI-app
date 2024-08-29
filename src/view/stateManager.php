<?php

class StateManager
{
    private State $state;

    public function __construct(State $initialState)
    {
        $this->state = $initialState;
    }

    public function run(): void
    {
        $this->state->display();
        $this->displayOptions();
        $nextState = $this->state->handleInput();
        if ($nextState instanceof State) {
            $this->setState($nextState);
        }
    }

    private function displayOptions(): void
    {
        echo "Choose an option:\n";
        $options = $this->state->getOptions();
        $keys = array_keys($options);
        foreach ($keys as $index => $option) {
            $number = $index + 1;
            if ($index === $this->state->getSelectedIndex()) {
                echo ConsoleStyle::apply("> [$number] $option", ['GREEN', 'BLINK']) . PHP_EOL;
            } else {
                echo "  [$number] $option\n";
            }
        }
    }

    public function setState(State $state): void
    {
        $this->state = $state;
    }
}
