<?php

class StateManager
{
    private State $state;

    public function __construct(State $initialState)
    {
        $this->state = $initialState;
    }

    public function render(): void
    {
        $this->state->display();
        $this->displaySelectableTable();
        $this->displayOptions();
        $nextState = $this->state->handleInput();
        if ($nextState instanceof State) {
            $this->setState($nextState);
        }
    }

    private function displaySelectableTable(): void
    {
        $header = $this->state->getTableHeader();
        $rows = $this->state->getTableData();
        if (!empty($rows)) {
            DataTable::displayTable($header, $rows, $this->state->getSelectedIndex(), $this->state->getColor());
        }
    }

    private function displayOptions(): void
    {
        echo "Choose an option:\n";
        $options = $this->state->getOptions();
        $keys = array_keys($options);
        $dataRowCount = count($this->state->getTableData());
        foreach ($keys as $index => $option) {
            if ($dataRowCount > 0 && $dataRowCount > $index)
                continue;
            $number = $index - $dataRowCount + 1;
            if ($index === $this->state->getSelectedIndex()) {
                echo ConsoleStyle::apply("> [$number] $option", ['GREEN', 'BLINK']) . PHP_EOL;
            } else {
                echo "  [$number] $option\n";
            }
        }
    }

    private function setState(State $state): void
    {
        $this->state = $state;
    }
}
