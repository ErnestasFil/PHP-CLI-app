<?php

class DataTable
{
    public static function displayTable(array $headers, array $rows): void
    {
        $columnWidths = self::calculateColumnWidths($headers, $rows);
        $lineWidth = self::calculateLineWidth($columnWidths);

        self::printLine($lineWidth);
        self::printRow($headers, $columnWidths);
        self::printLine($lineWidth);

        foreach ($rows as $row) {
            self::printRow($row, $columnWidths);
        }

        self::printLine($lineWidth);
        echo PHP_EOL;
    }

    private static function calculateColumnWidths(array $headers, array $rows): array
    {
        return array_map(function ($header, $index) use ($rows) {
            return max(strlen($header), ...array_map(fn($row) => strlen($row[$index]), $rows)) + 1;
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

    private static function printRow(array $row, array $widths): void
    {
        echo sprintf("|%s|" . PHP_EOL, implode('|', array_map(fn($w, $c) => sprintf(" %-{$w}s", $c), $widths, $row)));
    }
}
