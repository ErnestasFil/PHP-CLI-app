<?php

class DataInsertTable
{
    public static function createTable(array $result, string $modelName = ""): bool
    {
        if (isset($result['data'])) {
            self::createDataTable($result['data'], $modelName);
            return true;
        } else {
            self::createErrorTable($result['error']);
            return false;
        }
    }

    public static function createDataTable(array $data, string $modelName): void
    {
        if (strlen($modelName) > 0) {
            ConsoleStyle::clearScreen();
            TextTable::displayText(["/cData which will be shown in $modelName table:"]);
        }
        $headers = array_keys($data);
        $rows = array_values($data);
        DataTable::displayTable($headers, [$rows]);
    }

    public static function createErrorTable(array $errors): void
    {
        ConsoleStyle::clearScreen();
        TextTable::displayText(["/cError with data:"]);

        $lines = [];
        foreach ($errors as $field => $messages) {
            $lines[] = ConsoleStyle::apply("Error in field - $field", ['RED']);
            $lines = array_merge($lines, $messages);
            $lines[] = "/br";
        }
        array_pop($lines);
        TextTable::displayText($lines);
    }

}