<?php

class SelectEditDonationState extends BaseSelectState
{
    public function __construct()
    {
        $this->tableHeader = ['OPTION', 'ID', 'Charity ID', 'Donor name', 'Amount', 'Date'];
        $this->backState = new ViewDonationState();
        $this->actionText = "donation information you want to edit";
    }

    protected function getData(): array
    {
        return Donation::getAll();
    }

    protected function createOptions(mixed $data): void
    {
        $this->options["Edit Donation ID " . $data->id] = new EditDonationState($data->id);
    }

    protected function mapItemToTableRow(mixed $item, int $index): array
    {
        return [
            "[$index]",
            $item->id,
            $item->charity_id,
            $item->donor_name,
            number_format($item->amount, 2),
            $item->date_time
        ];
    }
}
