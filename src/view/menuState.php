<?php

class MenuState extends BaseState
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
            'View charities' => new ViewCharityState(),
            'View donations' => new ViewDonationState(),
            'Exit' => new ExitState()
        ];
        $this->lines = [
            "/cPHP Internship Homework Task",
            "/br",
            "To change the menu state, use the arrow keys on your keyboard.",
            "To confirm your selection click on the \"ENTER\" button."
        ];
    }

    protected function createState($selectedOption)
    {
        return $this->options[$selectedOption];
    }
}
