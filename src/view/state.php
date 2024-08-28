<?php

interface State
{
    public function display();
    public function handleInput();
    public function getOptions();
    public function getSelectedIndex();
}
