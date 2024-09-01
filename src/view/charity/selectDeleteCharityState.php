<?php

class SelectDeleteCharityState extends BaseSelectState
{
    public function __construct()
    {
        $this->color = "RED";
        $this->tableHeader = ['ID', 'Name', 'Email'];
        $this->backState = new ViewCharityState();
        $this->actionText = "charity information you want to delete";
    }

    protected function getData(): array
    {
        return Charity::getAll();
    }

    protected function createOptions(mixed $data): void
    {
        $this->options["Delete Charity ID " . $data->id] = new DeleteCharityState($data->id);
    }

    protected function mapItemToTableRow(mixed $item): array
    {
        return [$item->id, $item->name, $item->email];
    }
}
