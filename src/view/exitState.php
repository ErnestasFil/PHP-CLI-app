<?php

class ExitState extends BaseState
{
    protected array $options;
    protected $lines;

    public function __init()
    {
        $this->options = [
            'Yes' => "Exit",
            'No' => new MenuState()
        ];

        $this->lines = [
            "/cAre you sure that you want to stop this program?",
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
        if ($selectedOption == "No")
            return $this->options[$selectedOption];

        CLI::clearScreen();
        echo "\033[?25h";
        exit('');
    }
}
