<?php

class ExistRule implements Rule
{
    protected $modelName;
    protected string $columnName;

    public function __construct($modelName, $columnName)
    {
        $this->modelName = $modelName;
        $this->columnName = $columnName;
    }

    public function passes($value): bool
    {
        return $this->modelName::getCount($this->columnName, $value) > 0;
    }

    public function message(): string
    {
        return "The selected :attribute not exist in $this->modelName.";
    }
}