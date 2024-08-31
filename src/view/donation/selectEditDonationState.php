<?php

class SelectEditDonationState extends BaseState
{
    protected array $options;
    protected array $lines;
    protected array $tableData;
    protected array $tableHeader;
    protected string $color = "GREEN";

    public function display(): void
    {
        ConsoleStyle::clearScreen();
        $this->charitiesInfo();
        self::__init();
        TextTable::displayText($this->lines);
    }

    private function charitiesInfo(): void
    {
        $donations = Donation::getAll();

        $this->tableHeader = ['ID', 'Charity ID', 'Donor name', 'Amount', 'Date'];
        $this->tableData = array_map(function ($donation) {
            return [$donation->id, $donation->charity_id, $donation->donor_name, number_format($donation->amount, 2), $donation->date_time];
        }, $donations);

        foreach ($donations as $donation) {
            $this->options["Edit Donation ID " . $donation->id] = new EditDonationState($donation->id);
        }
    }

    public function __init(): void
    {
        $this->options["Back"] = new ViewDonationState();
        $this->lines = [
            "/cChoose which donation information you want to edit and press \"ENTER\"."
        ];
    }
}
