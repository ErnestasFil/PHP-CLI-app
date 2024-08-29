<?php

class ViewCharityState extends BaseState
{
    protected array $options;

    public function display(): void
    {
        ConsoleStyle::clearScreen();
        self::__init();
        $this->charitiesTable();
    }

    public function __init(): void
    {
        $this->options = [
            "Add charity" => new AddCharityState(),
            "Edit charity" => new MenuState(),
            "Delete charity" => new MenuState(),
            "Back" => new MenuState(),
        ];
    }

    private function charitiesTable(): void
    {
        $charities = Charity::getAll();

        $headers = ['ID', 'Name', 'Email'];
        $rows = array_map(function ($charity) {
            return [$charity->id, $charity->name, $charity->email];
        }, $charities);

        DataTable::displayTable($headers, $rows);
    }


}
