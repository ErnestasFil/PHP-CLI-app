<?php

class EditDonationState extends BaseState
{
    protected array $options;
    protected int $donationId;
    protected Validator $validator;
    protected array $lines;
    protected array $receivedData;
    protected bool $inserted = false;
    protected bool $noError = false;

    public function __construct(int $donationId, array $receivedData = null)
    {
        $this->donationId = $donationId;
        $this->receivedData = $receivedData !== null ? $receivedData : Donation::findById($donationId);
    }

    public function display(): void
    {
        ConsoleStyle::clearScreen();
        if (!$this->inserted) {
            self::__init();
            TextTable::displayText($this->lines);
            $this->inserted = 1;
            $this->noError = $this->handleDonationInput();
            if (!$this->noError) {
                $this->options = [
                        'Fix previously edited data' => new EditDonationState($this->donationId, $this->receivedData)] + $this->options;
            }
        } else
            DataInsertTable::createErrorTable($this->validator->getErrors());

    }

    public function __init(): void
    {
        $this->options = [
            "Back" => new SelectEditDonationState(),
        ];
        $this->lines = [
            "/cInformation edit for donation id: $this->donationId.",
            "/br",
            "Leave input empty if you want to keep original or edited value and press \"ENTER\"!"
        ];
    }

    public function handleDonationInput(): bool
    {
        $rules = [
            'donor_name' => ['notEmpty', 'min:str:5', 'max:str:30', 'string'],
            'amount' => ['notEmpty', 'min:num:5.00', 'num:double:2'],
            'charity_id' => ['notEmpty', 'min:num:1', 'num:integer', 'exist:Charity:id'],
            'date_time' => ['notEmpty', 'datetime', 'max:datetime:now'],
        ];

        $variables = [
            "donor_name" => "Enter donation donor name: ",
            "amount" => "Enter donation amount: ",
            "charity_id" => "Enter donation charity id: ",
            "date_time" => "Enter donation date time: ",
        ];
        return $this->handleDataInput($rules, $variables);
    }

    protected function handleDataInput(array $rules, array $variables): bool
    {
        $this->validator = new Validator($rules, false);
        $this->receivedData = ConsoleInput::getDataInput($variables, $this->receivedData);
        $validationResult = $this->validator->validateInput($this->receivedData);
        $valid = DataInsertTable::createTable($validationResult, 'Donation');
        if ($valid)
            Donation::updateById($this->donationId, $validationResult['data']);
        return $valid;
    }
}
