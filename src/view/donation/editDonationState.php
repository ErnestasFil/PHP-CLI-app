<?php

class EditDonationState extends BaseFormState
{
    protected array $rules = [
        'donor_name' => ['notEmpty', 'min:str:5', 'max:str:30', 'string'],
        'amount' => ['notEmpty', 'min:num:5.00', 'num:double:2'],
        'charity_id' => ['notEmpty', 'min:num:1', 'num:integer', 'exist:Charity:id'],
        'date_time' => ['notEmpty', 'datetime', 'max:datetime:now'],
    ];
    protected array $variables = [
        "donor_name" => "Enter donation donor name: ",
        "amount" => "Enter donation amount: ",
        "charity_id" => "Enter donation charity id: ",
        "date_time" => "Enter donation date time: ",
    ];

    public function __construct(int $id, ?array $receivedData = null)
    {
        $receivedData = $receivedData ?? Donation::findById($id);
        parent::__construct($id, $receivedData);
    }

    public function __init(): void
    {
        $this->tableName = 'Donation';
        $this->backState = new SelectEditDonationState();
        $this->lines = [
            "/cInformation edit for $this->tableName id: $this->id.",
            "/br",
            "Leave input empty if you want to keep original or edited value and press \"ENTER\"!"
        ];
    }

    protected function saveData(array $data): void
    {
        Donation::updateById($this->id, $data);
    }
}