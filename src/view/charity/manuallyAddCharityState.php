<?php

class ManuallyAddCharityState extends BaseState
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
                $this->options = ['Add more charities' => new ManuallyAddCharityState()] + $this->options;
            } else {
                $this->options = [
                        'Fix previously inserted data' => new ManuallyAddCharityState($this->receivedData),
                        'Try again' => new ManuallyAddCharityState()]
                    + $this->options;
            }
        } else {
            if ($this->noError)
                DataInsertTable::createDataTable($this->receivedData, 'Charity');
            else
                DataInsertTable::createErrorTable($this->validator->getErrors());
        }
    }

    public function __init(): void
    {
        $this->options = [
            'Back' => new AddCharityState()
        ];
        $this->lines = [
            "/cInsert new data for Charities table."
        ];
    }

    public function handleCharityInput(): bool
    {
        $rules = [
            'name' => ['notEmpty', 'min:str:5', 'max:str:20', 'string'],
            'email' => ['notEmpty', 'email', 'unique:Charity:email']
        ];

        $variables = [
            "name" => "Enter charity name: ",
            "email" => "Enter charity email: "
        ];
        return $this->handleDataInput($rules, $variables);
    }

    protected function handleDataInput(array $rules, array $variables): bool
    {
        $this->validator = new Validator($rules, false);
        $this->receivedData = CLI::getDataInput($variables, $this->receivedData);
        return DataInsertTable::createTable($this->validator->validateInput($this->receivedData), 'Charity', Charity::class);
    }
}