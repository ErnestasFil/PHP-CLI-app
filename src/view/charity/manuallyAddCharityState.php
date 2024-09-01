<?php

class ManuallyAddCharityState extends BaseFormState
{
    protected array $rules = [
        'name' => ['notEmpty', 'min:str:5', 'max:str:20', 'string'],
        'email' => ['notEmpty', 'email', 'unique:Charity:email']
    ];

    protected array $variables = [
        "name" => "Enter charity name: ",
        "email" => "Enter charity email: "
    ];

    public function __init(): void
    {
        $this->tableName = 'Charity';
        $this->backState = new AddCharityState();
        $this->lines = [
            "/cInsert new data for $this->tableName table."
        ];
    }

    protected function saveData(array $data): void
    {
        Charity::insert($data);
    }
}