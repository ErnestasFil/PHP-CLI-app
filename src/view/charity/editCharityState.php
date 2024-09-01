<?php

class EditCharityState extends BaseFormState
{
    protected array $rules = [
        'name' => ['notEmpty', 'min:str:5', 'max:str:20', 'string'],
        'email' => ['notEmpty', 'email']
    ];
    protected array $variables = [
        "name" => "Enter new charity name: ",
        "email" => "Enter new charity email: "
    ];

    public function __construct(int $id, ?array $receivedData = null)
    {
        $receivedData = $receivedData ?? Charity::findById($id);
        parent::__construct($id, $receivedData);
    }

    public function __init(): void
    {
        $this->tableName = 'Charity';
        $this->backState = new SelectEditCharityState();
        $this->lines = [
            "/cInformation edit for $this->tableName id: $this->id.",
            "/br",
            "Leave input empty if you want to keep original or edited value and press \"ENTER\"!"
        ];
    }

    protected function saveData(array $data): void
    {
        Charity::updateById($this->id, $data);
    }
}
