<?php

class ImportCharityState extends BaseState
{
    protected array $options;
    protected array $lines;

    public function display(): void
    {
        self::__init();
        ConsoleStyle::clearScreen();
        TextTable::displayText($this->lines);

        $selectedFile = CLI::getSelectedFile();

        if ($selectedFile) {
            $rules = [
                'name' => ['notEmpty', 'min:str:5', 'max:str:20', 'string'],
                'email' => ['notEmpty', 'email', 'unique:Charity:email']
            ];

            $validator = new Validator($rules, false);
            $data = CSVImport::import($selectedFile, Charity::class, $validator);
            DataImportTable::createTable($data, 'Charity', Charity::class);

        } else {
            TextTable::displayText(["No file selected!"]);
        }
    }

    public function __init(): void
    {
        $this->options = [
            'Back' => new AddCharityState()
        ];
        $this->lines = [
            "/cSelect CSV file with charities data."
        ];
    }


    protected function createState($selectedOption)
    {
        return $this->options[$selectedOption];
    }
}
