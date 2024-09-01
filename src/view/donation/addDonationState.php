<?php

class AddDonationState extends BaseState
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
            'Import CSV file' => new ImportDonationState(),
            'Add manually' => new ManuallyAddDonationState(),
            'Back' => new ViewDonationState()
        ];
        $this->lines = [
            "/cChoose how you would like to add donation information."
        ];
    }
}
