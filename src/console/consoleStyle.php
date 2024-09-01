<?php

class ConsoleStyle
{
    const RESET = "\033[0m";
    const BLINK = "\033[6m";
    const RED = "\033[31m";
    const GREEN = "\033[32m";
    const START_CURSOR = "\033[H";
    const CLEAR_SCREEN = "\033[J";
    const CONSOLE_WIDTH = 90;

    public static function apply(string $text, array $styles = []): string
    {
        $styleCodes = array_map(fn($style) => constant("self::$style"), $styles);
        return implode('', $styleCodes) . $text . self::RESET;
    }

    public static function clearScreen(): void
    {
        echo self::START_CURSOR . self::CLEAR_SCREEN;
    }

    public static function stripAnsiCodes(string $text): string
    {
        return preg_replace('/\033\[[0-9;]*m/', '', $text);
    }

    public static function fixPadding(string $text, int $width): string
    {
        return ' ' . $text . str_repeat(' ', $width - mb_strwidth($text, 'UTF-8'));
    }
}
