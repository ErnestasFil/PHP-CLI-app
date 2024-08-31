<?php

class ExitState extends BaseState
{
    protected array $options;
    protected array $lines;

    public function display(): void
    {
        ConsoleStyle::clearScreen();
        self::__init();
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

    protected function createState(string $selectedOption): BaseState
    {
        if ($selectedOption == "No")
            return $this->options[$selectedOption];

        ConsoleStyle::clearScreen();
        echo ConsoleStyle::VISIBLE_CURSOR;
        exit('');
    }
}
