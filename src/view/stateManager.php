<?php
class StateManager
{
    private $state;
    private $history = [];

    public function __construct(State $initialState)
    {
        $this->state = $initialState;
    }

    public function setState(State $state)
    {
        $this->history[] = clone new $this->state;
        $this->state = $state;
    }

    public function restorePreviousState()
    {
        if (!empty($this->history)) {
            $this->state = array_pop($this->history);
        } else {
            $this->state = new ExitState();
        }
    }

    public function run()
    {
        ConsoleStyle::clearScreen();
        $this->state->display();
        $this->displayOptions();
        $nextState = $this->state->handleInput();

        if ($nextState === 'back') {
            $this->restorePreviousState();
        } elseif ($nextState instanceof State) {
            $this->setState($nextState);
        }
    }

    private function displayOptions()
    {
        echo "Choose an option:\n";
        $options = $this->state->getOptions();
        $keys = array_keys($options);
        foreach ($keys as $index => $option) {
            $number=$index+1;
            if ($index === $this->state->getSelectedIndex()) {
                echo ConsoleStyle::apply("> [$number] $option", ['GREEN', 'BLINK']);
            } else {
                echo "  [$number] $option\n";
            }
        }
    }
}
