<?php
class TextTable
{
    const  CONSOLE_WIDTH = 90;
    public static function displayText(array $lines): void
    {
        DataTable::printLine(self::CONSOLE_WIDTH);

        foreach ($lines as $line) {
            $alignment = 'left';
            if (substr($line, 0, 2) === '/c') {
                $line = substr($line, 2);
                $alignment = 'center';
            } elseif (substr($line, 0, 2) === '/r') {
                $line = substr($line, 2);
                $alignment = 'right';
            } elseif (substr($line, 0, 3) === '/br') {
                $line = substr($line, 3);
                DataTable::printLine(self::CONSOLE_WIDTH);
                continue;
            }
            
            $paddedLine = match ($alignment) {
                'left' => str_pad($line, self::CONSOLE_WIDTH - 4, ' ', STR_PAD_RIGHT),
                'right' => str_pad($line, self::CONSOLE_WIDTH - 4, ' ', STR_PAD_LEFT),
                'center' => str_pad($line, self::CONSOLE_WIDTH - 4, ' ', STR_PAD_BOTH)
            };

            echo "| {$paddedLine} |" . PHP_EOL;
        }

        DataTable::printLine(self::CONSOLE_WIDTH);
        echo PHP_EOL;
    }
}
