<?php

class AddCharityState extends BaseState
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
            'Import CSV file' => new ImportCharityState(),
            'Add manually' => new ManuallyAddCharityState(),
            'Back' => new ViewCharityState()
        ];
        $this->lines = [
            "/cChoose how you would like to add charity information."
        ];
    }
}
