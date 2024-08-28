<?php

class CLI
{
    public static function clearScreen(): void
    {
        echo "\033[?25l";
        echo "\033[H";
        echo "\033[J";
    }

    public static function getInput(): String
    {
        $python = 'python -c "exec(\'import msvcrt\nkey=msvcrt.getch()\nif key == b\"\\\\xe0\":\n    key += msvcrt.getch()\nprint(key)\')"';

        exec($python, $output);
        $str = preg_replace("/b\'([^']*)\'/", '$1', $output[0]);

        return match ($str) {
            '\r' => 'enter',
            '\xe0H' => 'up',
            '\xe0P' => 'down',
            '\x1b' => 'esc',
            default => '',
        };
    }

    
}
