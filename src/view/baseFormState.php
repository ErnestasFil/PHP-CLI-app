<?php

abstract class BaseFormState extends BaseState
{
    protected ?int $id = null;
    protected ?array $receivedData = null;
    protected Validator $validator;
    protected bool $inserted = false;
    protected bool $noError = false;
    protected array $rules = [];
    protected array $variables = [];
    protected string $tableName;

    public function __construct(?int $id = null, ?array $receivedData = null)
    {
        $this->id = $id;
        $this->receivedData = $receivedData ?? [];
    }

    public function display(): void
    {
        ConsoleStyle::clearScreen();
        if (!$this->inserted) {
            $this->__init();
            TextTable::displayText($this->lines);
            $this->inserted = true;
            $this->noError = $this->handleDataInput();
            $this->setOptions();
        } else {
            $this->handlePostInsert();
        }
    }

    private function handleDataInput(): bool
    {
        $this->validator = new Validator($this->rules, false);
        $this->receivedData = ConsoleInput::getDataInput($this->variables, $this->receivedData);
        $validationResult = $this->validator->validateInput($this->receivedData);
        $valid = DataInsertTable::createTable($validationResult, $this->tableName);
        if ($valid) {
            $this->saveData($validationResult['data']);
        }
        return $valid;
    }

    abstract protected function saveData(array $data): void;

    private function setOptions(): void
    {
        if ($this->id !== null && !$this->noError) {
            $this->options['Fix previously edited data'] = $this->createNewInstance($this->id, $this->receivedData);
        } elseif ($this->id === null && $this->noError) {
            $this->options['Add more data to ' . $this->tableName . ' table'] = $this->createNewInstance();
        } elseif ($this->id === null) {
            $this->options['Fix previously inserted data'] = $this->createNewInstance($this->id, $this->receivedData);
            $this->options['Try again'] = $this->createNewInstance();
        }
        $this->options['Back'] = $this->backState;
    }

    protected function createNewInstance(?int $id = null, ?array $receivedData = null): static
    {
        return new static($id, $receivedData);
    }

    private function handlePostInsert(): void
    {
        if ($this->noError) {
            DataInsertTable::createDataTable($this->receivedData, $this->tableName);
        } else {
            DataInsertTable::createErrorTable($this->validator->getErrors());
        }
    }
}
