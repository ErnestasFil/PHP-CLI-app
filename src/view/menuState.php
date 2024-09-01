<?php

class MenuState extends BaseState
{
    public function display(): void
    {
        ConsoleStyle::clearScreen();
        self::__init();
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
}
