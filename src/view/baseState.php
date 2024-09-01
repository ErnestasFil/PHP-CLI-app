<?php

abstract class BaseState implements State
{
    protected array $lines = [];
    protected array $options = [];
    protected array $tableData = [];
    protected array $tableHeader = [];
    protected BaseState $backState;

    public function handleInput(): BaseState|null
    {
        $input = ConsoleInput::getDataInput(['option' => ConsoleStyle::apply('Enter option number: ', ["GREEN", "BLINK"])]);
        return $this->selectOption($input['option']);
    }

    protected function selectOption(mixed $input): BaseState|null
    {
        $keys = array_keys($this->options);
        if (filter_var($input, FILTER_VALIDATE_INT) && array_key_exists($input - 1, $keys)) {
            $selectedOption = $keys[$input - 1];
            return $this->createState($selectedOption);
        }
        return null;
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
}
