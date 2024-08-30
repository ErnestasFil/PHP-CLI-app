<?php

class SelectDeleteCharityState extends BaseState
{
    protected array $options;
    protected array $lines;
    protected array $tableData;
    protected array $tableHeader;
    protected string $color = "RED";

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
            $this->options["Delete Charity ID " . $charity->id] = new DeleteCharityState($charity->id);
        }
    }

    public function __init(): void
    {
        $this->options["Back"] = new ViewCharityState();
        $this->lines = [
            "/cChoose which charity information you want to delete and press \"ENTER\".",
            "/br",
            "/c" . ConsoleStyle::apply("Information, which have donation data will be removed also!", ["RED"])
        ];
    }

}
