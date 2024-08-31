<?php

class ExistRule implements Rule
{
    protected mixed $modelName;
    protected string $columnName;

    public function __construct(mixed $modelName, string $columnName)
    {
        $this->modelName = $modelName;
        $this->columnName = $columnName;
    }

    public function passes(mixed $value): bool
    {
        return $this->modelName::getCount($this->columnName, $value) > 0;
    }

    public function message(): string
    {
        return "The selected :attribute not exist in $this->modelName.";
    }
}