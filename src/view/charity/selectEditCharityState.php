<?php

class SelectEditCharityState extends BaseState
{
    protected array $options;
    protected array $lines;
    protected array $tableData;
    protected array $tableHeader;

    public function display(): void
    {
        ConsoleStyle::clearScreen();
        $this->charitiesInfo();
        self::__init();
        TextTable::displayText($this->lines);
    }

    private function charitiesInfo(): void
    {
        $charities = Charity::getAll();

        $this->tableHeader = ['ID', 'Name', 'Email'];
        $this->tableData = array_map(function ($charity) {
            return [$charity->id, $charity->name, $charity->email];
        }, $charities);

        foreach ($charities as $charity) {
            $this->options["Edit Charity ID " . $charity->id] = new EditCharityState($charity->id);
        }
    }

    public function __init(): void
    {
        $this->options["Back"] = new ViewCharityState();
        $this->lines = [
            "/cChoose which charity information you want to edit and press \"ENTER\"."
        ];
    }
}
