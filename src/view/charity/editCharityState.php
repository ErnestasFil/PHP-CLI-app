<?php

class EditCharityState extends BaseState
{
    protected array $options;
    protected int $charityId;
    protected Validator $validator;
    protected array $lines;
    protected array $receivedData;
    protected bool $inserted = false;
    protected bool $noError = false;

    public function __construct(int $charityId, array $receivedData = null)
    {
        $this->charityId = $charityId;
        $this->receivedData = $receivedData !== null ? $receivedData : Charity::findById($charityId);
    }

    public function display(): void
    {
        ConsoleStyle::clearScreen();
        if (!$this->inserted) {
            self::__init();
            TextTable::displayText($this->lines);
            $this->inserted = 1;
            $this->noError = $this->handleCharityInput();
            if (!$this->noError) {
                $this->options = [
                        'Fix previously edited data' => new EditCharityState($this->charityId, $this->receivedData)] + $this->options;
            }
        } else
            DataInsertTable::createErrorTable($this->validator->getErrors());

    }

    public function __init(): void
    {
        $this->options = [
            "Back" => new SelectEditCharityState(),
        ];
        $this->lines = [
            "/cInformation edit for charity id: {$this->charityId}.",
            "/br",
            "Leave input empty if you want to keep original or edited value and press \"ENTER\"!"
        ];
    }

    public function handleCharityInput(): bool
    {
        $rules = [
            'name' => ['notEmpty', 'min:str:5', 'max:str:20', 'string'],
            'email' => ['notEmpty', 'email']
        ];

        $variables = [
            "name" => "Enter new charity name: ",
            "email" => "Enter new charity email: "
        ];
        return $this->handleDataInput($rules, $variables);
    }

    protected function handleDataInput(array $rules, array $variables): bool
    {
        $this->validator = new Validator($rules, false);
        $this->receivedData = ConsoleInput::getDataInput($variables, $this->receivedData);
        $validationResult = $this->validator->validateInput($this->receivedData);
        $valid = DataInsertTable::createTable($validationResult, 'Charity');
        if ($valid)
            Charity::updateById($this->charityId, $validationResult['data']);
        return $valid;
    }
}
