<?php

class ManuallyAddCharityState extends BaseState
{
    protected array $options;
    protected array $lines;

    public function display(): void
    {
        self::__init();
        ConsoleStyle::clearScreen();
        TextTable::displayText($this->lines);
    }

    public function __init(): void
    {
        $this->options = [

            'Back' => new ViewCharityState()
        ];
//        $this->lines = [
//            "/cChoose how you would like to add charity information."
//        ];
    }

    protected function createState($selectedOption)
    {
        return $this->options[$selectedOption];
    }
}
