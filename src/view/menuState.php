<?php

class MenuState extends BaseState
{
    protected array $options;
    protected $lines;

    public function __init()
    {
        $this->options = [
            'View charities' => new ViewCharityView(),
            'Exit' => new ExitState()
        ];
        $this->lines = [
            "/cPHP Internship Homework Task",
            "/br",
            "To change the menu state, use the arrow keys on your keyboard.",
            "To return to the previous state or exit the program press the \"ESC\" button.",
            "To confirm your selection click on the \"ENTER\" button."
        ];
    }

    public function display()
    {
        self::__init();
        ConsoleStyle::clearScreen();
        TextTable::displayText($this->lines);
    }


    protected function createState($selectedOption)
    {
        return $this->options[$selectedOption];
    }
}
