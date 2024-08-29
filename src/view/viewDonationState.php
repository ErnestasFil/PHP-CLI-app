<?php

class ViewDonationState extends BaseState
{
    protected array $options;

    public function __init()
    {
        $this->options = [
            "Add donation" => new AddCharityState(),
            "Edit donation" => new MenuState(),
            "Delete donation" => new MenuState(),
            "Back" => new MenuState(),
        ];
    }

    public function display(): void
    {
        self::__init();
        ConsoleStyle::clearScreen();
        $this->donationsTable();
    }

    protected function createState($selectedOption): BaseState
    {
        return $this->options[$selectedOption];
    }

    private function donationsTable(): void
    {
        $donations = Donation::getAll();

        $headers = ['ID', 'Charity ID', 'Donor name', 'Amount', 'Date'];
        $rows = array_map(function ($donation) {
            return [$donation->id, $donation->charity_id, $donation->donor_name, $donation->amount, $donation->date_time];
        }, $donations);

        DataTable::displayTable($headers, $rows);
    }
}
