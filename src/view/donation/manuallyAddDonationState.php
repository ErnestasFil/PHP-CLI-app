<?php

class ManuallyAddDonationState extends BaseState
{
    protected array $options;
    protected array $lines;
    protected array $receivedData;
    protected Validator $validator;
    protected bool $inserted = false;
    protected bool $noError = false;

    public function __construct(array $receivedData = [])
    {
        $this->receivedData = $receivedData;
    }

    public function display(): void
    {

        ConsoleStyle::clearScreen();
        if (!$this->inserted) {
            self::__init();
            TextTable::displayText($this->lines);
            $this->inserted = 1;
            $this->noError = $this->handleCharityInput();
            if ($this->noError) {
                $this->options = ['Add more donations' => new ManuallyAddDonationState()] + $this->options;
            } else {
                $this->options = [
                        'Fix previously inserted data' => new ManuallyAddDonationState($this->receivedData),
                        'Try again' => new ManuallyAddDonationState()]
                    + $this->options;
            }
        } else {
            if ($this->noError)
                DataInsertTable::createDataTable($this->receivedData, 'Donation');
            else
                DataInsertTable::createErrorTable($this->validator->getErrors());
        }
    }

    public function __init(): void
    {
        $this->options = [
            'Back' => new AddDonationState()
        ];
        $this->lines = [
            "/cInsert new data for Donation table."
        ];
    }

    public function handleCharityInput(): bool
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
            Donation::insert($validationResult['data']);
        return $valid;
    }
}