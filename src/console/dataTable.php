<?php

class DataTable
{
    public static function displayTable(array $headers, array $rows): void
    {
        if (!empty($rows)) {
            $columnWidths = self::calculateColumnWidths($headers, $rows);
            $lineWidth = self::calculateLineWidth($columnWidths);

            self::printLine($lineWidth);
            echo self::printRow($headers, $columnWidths);
            self::printLine($lineWidth);

            foreach ($rows as $row) {
                echo self::printRow($row, $columnWidths);
            }
            self::printLine($lineWidth);
            echo PHP_EOL;
        } else {
            TextTable::displayText(["/cNo data found in database"]);
        }
    }

    private static function calculateColumnWidths(array $headers, array $rows): array
    {
        return array_map(function ($header, $index) use ($rows) {
            return max(mb_strwidth($header, 'utf-8'), ...array_map(fn($row) => mb_strwidth($row[$index], 'utf-8'), $rows)) + 1;
        }, $headers, array_keys($headers));
    }

    private static function calculateLineWidth(array $widths): int
    {
        return array_sum($widths) + count($widths) * 2 + 1;
    }

    public static function printLine(int $length): void
    {
        echo str_repeat('*', $length) . PHP_EOL;
    }

    private static function printRow(array $row, array $widths): string
    {
        return sprintf("|%s|" . PHP_EOL, implode('|', array_map(fn($width, $cell) => ConsoleStyle::fixPadding($cell, $width), $widths, $row)));
    }

}
