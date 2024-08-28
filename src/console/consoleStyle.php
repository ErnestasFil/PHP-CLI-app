<?php

class ConsoleStyle
{
    const RESET = "\033[0m";
    const BOLD = "\033[1m";
    const UNDERLINE = "\033[4m";
    const BLINK = "\033[6m";
    const RED = "\033[31m";
    const GREEN = "\033[32m";
    const YELLOW = "\033[33m";
    const BLUE = "\033[34m";
    const MAGENTA = "\033[35m";
    const CYAN = "\033[36m";
    const WHITE = "\033[37m";
    const START_CURSOR = "\033[H";
    const CLEAR_SCREEN = "\033[J";
    const INVISIBLE_CURSOR = "\033[?25l";
    const VISIBLE_CURSOR = "\033[?25h";

    public static function apply($text, $styles = [])
    {
        $styleCodes = array_map(fn($style) => constant("self::$style"), $styles);
        return implode('', $styleCodes) . $text . PHP_EOL . self::RESET;
    }

    public static function clearScreen(): void
    {
        echo self::INVISIBLE_CURSOR . self::START_CURSOR . self::CLEAR_SCREEN;
    }
}
