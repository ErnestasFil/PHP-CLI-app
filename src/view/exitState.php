<?php

class ExitState extends BaseState
{
    protected array $options;
    protected array $lines;

    public function display(): void
    {
        self::__init();
        ConsoleStyle::clearScreen();
        TextTable::displayText($this->lines);
    }

    public function __init(): void
    {
        $this->options = [
            'Yes' => "Exit",
            'No' => new MenuState()
        ];

        $this->lines = [
            "/cAre you sure that you want to stop this program?",
        ];
    }

    protected function createState($selectedOption)
    {
        if ($selectedOption == "No")
            return $this->options[$selectedOption];

        ConsoleStyle::clearScreen();
        echo "\033[?25h";
        exit('');
    }
}
