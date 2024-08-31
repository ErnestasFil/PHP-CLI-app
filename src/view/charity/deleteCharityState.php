<?php

class DeleteCharityState extends BaseState
{
    protected array $options;
    protected array $lines;
    protected array $receivedData;
    protected int $charityId;

    public function __construct(int $charityId)
    {
        $this->charityId = $charityId;
        $this->receivedData = Charity::findById($charityId);
    }

    public function display(): void
    {
        ConsoleStyle::clearScreen();
        self::__init();
        TextTable::displayText($this->lines);
        DataInsertTable::createTable(["data" => $this->receivedData]);
    }

    public function __init(): void
    {
        $this->options = [
            "Yes" => new SelectDeleteCharityState(),
            "No" => new SelectDeleteCharityState()
        ];
        $this->lines = [
            "/cAre you sure that you want to delete this information?",
        ];
    }

    protected function createState(string $selectedOption): BaseState
    {
        if ($selectedOption == "Yes")
            Charity::deleteById($this->charityId);
        return $this->options[$selectedOption];
    }
}
