<?php

class ViewDonationState extends BaseState
{
    protected array $options;

    public function display(): void
    {
        ConsoleStyle::clearScreen();
        self::__init();
        $this->donationsTable();
    }

    public function __init(): void
    {
        $this->options = [
            "Add donation" => new AddDonationState(),
            "Edit donation" => new SelectEditDonationState(),
            "Delete donation" => new SelectDeleteDonationState(),
            "Back" => new MenuState(),
        ];
    }

    private function donationsTable(): void
    {
        $donations = Donation::getAll();

        $headers = ['ID', 'Charity ID', 'Donor name', 'Amount', 'Date'];
        $rows = array_map(function ($donation) {
            return [$donation->id, $donation->charity_id, $donation->donor_name, number_format($donation->amount, 2), $donation->date_time];
        }, $donations);

        DataTable::displayTable($headers, $rows);
    }
}
