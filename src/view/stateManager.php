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
            DataTable::displayTable($header, $rows);
        }
    }

    private function displayOptions(): void
    {
        echo "Choose an option:" . PHP_EOL;
        $options = $this->state->getOptions();
        $keys = array_keys($options);
        $dataRowCount = count($this->state->getTableData());
        foreach ($keys as $index => $option) {
            if ($dataRowCount > 0 && $dataRowCount > $index)
                continue;
            $number = $index + 1;
            echo "  [$number] $option" . PHP_EOL;
        }
        echo PHP_EOL;
    }

    private function setState(State $state): void
    {
        $this->state = $state;
    }
}
