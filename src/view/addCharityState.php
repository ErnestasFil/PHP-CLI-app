<?php

class AddCharityState extends BaseState
{
    protected array $options;
    protected $lines;

    public function __init()
    {
        $this->options = [
            'Import CSV file' => new ViewCharityView(),
            'Add manually' => new ViewCharityView(),
            'Back' => new ViewCharityView()
        ];
        $this->lines = [
            "/cChoose how you would like to add charity information."
        ];
    }

    public function display()
    {
        self::__init();
        ConsoleStyle::clearScreen();
        TextTable::displayText($this->lines);
    }


    protected function createState($selectedOption)
    {
        return $this->options[$selectedOption];
    }
}
