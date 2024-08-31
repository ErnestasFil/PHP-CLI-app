<?php

class DeleteDonationState extends BaseState
{
    protected array $options;
    protected array $lines;
    protected array $receivedData;
    protected int $donationId;

    public function __construct(int $donationId)
    {
        $this->donationId = $donationId;
        $this->receivedData = Donation::findById($donationId);
    }

    public function display(): void
    {
        ConsoleStyle::clearScreen();
        self::__init();
        TextTable::displayText($this->lines);
        DataInsertTable::createTable(["data" => $this->receivedData]);
    }

    public function __init(): void
    {
        $this->options = [
            "Yes" => new SelectDeleteDonationState(),
            "No" => new SelectDeleteDonationState()
        ];
        $this->lines = [
            "/cAre you sure that you want to delete this information?",
        ];
    }

    protected function createState($selectedOption)
    {
        if ($selectedOption == "Yes")
            Donation::deleteById($this->donationId);
        return $this->options[$selectedOption];
    }
}
