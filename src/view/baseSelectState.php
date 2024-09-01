<?php

abstract class BaseSelectState extends BaseState
{
    protected string $actionText;

    public function display(): void
    {
        ConsoleStyle::clearScreen();
        $this->getInfo();
        $this->__init();
        TextTable::displayText($this->lines);
    }

    protected function getInfo(): void
    {
        $data = $this->getData();
        $this->tableData = array_map(
            function ($item, $index) {
                return $this->mapItemToTableRow($item, $index + 1);
            },
            $data, array_keys($data)
        );

        foreach ($data as $item) {
            $this->createOptions($item);
        }
    }

    abstract protected function getData(): array;

    protected function mapItemToTableRow(mixed $item, int $index): array
    {
        return (array)$item;
    }

    abstract protected function createOptions(mixed $data): void;

    public function __init(): void
    {
        $this->options["Back"] = $this->backState;
        $this->lines = [
            "/cChoose which " . $this->actionText . " and press \"ENTER\"."
        ];
    }

}
