<?php

class ImportDonationState extends BaseState
{
    public function display(): void
    {
        ConsoleStyle::clearScreen();
        self::__init();
        TextTable::displayText($this->lines);

        $selectedFile = ConsoleInput::getSelectedFile();

        if ($selectedFile) {
            $rules = [
                'donor_name' => ['notEmpty', 'min:str:5', 'max:str:30', 'string'],
                'amount' => ['notEmpty', 'min:num:5.00', 'num:double:2'],
                'charity_id' => ['notEmpty', 'min:num:1', 'num:integer', 'exist:Charity:id'],
                'date_time' => ['notEmpty', 'datetime', 'max:datetime:now'],
            ];

            $validator = new Validator($rules, false);
            $data = CSVImport::import($selectedFile, Donation::class, $validator);
            DataImportTable::createTable($data, 'Donation', Donation::class);

        } else {
            TextTable::displayText(["No file selected!"]);
        }
    }

    public function __init(): void
    {
        $this->options = [
            'Back' => new AddDonationState()
        ];
        $this->lines = [
            "/cSelect CSV file with donation data."
        ];
    }
}
