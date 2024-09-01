<?php

class TextTable
{
    public static function displayText(array $lines): void
    {
        DataTable::printLine(ConsoleStyle::CONSOLE_WIDTH);

        foreach ($lines as $line) {
            $alignment = 'left';
            if (str_starts_with($line, '/c')) {
                $line = substr($line, 2);
                $alignment = 'center';
            } elseif (str_starts_with($line, '/r')) {
                $line = substr($line, 2);
                $alignment = 'right';
            } elseif (str_starts_with($line, '/br')) {
                DataTable::printLine(ConsoleStyle::CONSOLE_WIDTH);
                continue;
            }
            $strippedLine = ConsoleStyle::stripAnsiCodes($line);

            $paddedLine = match ($alignment) {
                'left' => str_pad($line, ConsoleStyle::CONSOLE_WIDTH - 4 + mb_strlen($line) - mb_strlen($strippedLine)),
                'right' => str_pad($line, ConsoleStyle::CONSOLE_WIDTH - 4 + mb_strlen($line) - mb_strlen($strippedLine), ' ', STR_PAD_LEFT),
                'center' => str_pad($line, ConsoleStyle::CONSOLE_WIDTH - 4 + mb_strlen($line) - mb_strlen($strippedLine), ' ', STR_PAD_BOTH)
            };

            echo "| {$paddedLine} |" . PHP_EOL;
        }

        DataTable::printLine(ConsoleStyle::CONSOLE_WIDTH);
        echo PHP_EOL;
    }
}
