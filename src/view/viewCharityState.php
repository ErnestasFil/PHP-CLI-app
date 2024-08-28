<?php

class ViewCharityView extends BaseState
{
    protected array $options;

    public function __init()
    {
        $this->options = [
            "Add charity" => new AddCharityState(),
            "Edit charity" => new MenuState(),
            "Delete charity" => new MenuState(),
            "Add donation" => new MenuState(),
            "Back" => new MenuState(),
        ];
    }

    public function display(): void
    {
        self::__init();
        ConsoleStyle::clearScreen();
        $this->charitiesTable();
    }

    protected function createState($selectedOption): BaseState
    {
        return $this->options[$selectedOption];
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
