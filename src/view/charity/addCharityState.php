<?php

class AddCharityState extends BaseState
{
    protected array $options;
    protected $lines;

    public function display()
    {
        self::__init();
        ConsoleStyle::clearScreen();
        TextTable::displayText($this->lines);
    }

    public function __init()
    {
        $this->options = [
            'Import CSV file' => new ImportCharityState(),
            'Add manually' => new ViewCharityState(),
            'Back' => new ViewCharityState()
        ];
        $this->lines = [
            "/cChoose how you would like to add charity information."
        ];
    }

    protected function createState($selectedOption)
    {
        return $this->options[$selectedOption];
    }
}
