<?php

class DataImportTable
{
    public static function createTable(array $result, string $modelName, $modelClass = null): void
    {
        if (isset($result['data'])) {
            self::createDataTable($result['data'], $modelName);
            if ($modelClass !== null) {
                self::importData($result['data'], $modelClass);
            }
        } else {
            self::createErrorTable($result['error']);
        }
    }

    private static function createDataTable(array $data, string $modelName): void
    {
        ConsoleStyle::clearScreen();
        TextTable::displayText(["/cData which will be imported to $modelName table:"]);
        $headers = array_keys($data[0]);
        $rows = array_map(function ($item) {
            return array_values($item);
        }, $data);
        DataTable::displayTable($headers, $rows);
    }

    private static function importData(array $data, $modelClass): void
    {
        foreach ($data as $row) {
            $modelClass::insert($row);
        }
    }

    private static function createErrorTable(array $errors): void
    {

        ConsoleStyle::clearScreen();
        TextTable::displayText(["/cError when importing data:"]);

        if (isset($errors[0]) && is_string($errors[0])) {
            TextTable::displayText($errors);
            return;
        }

        $lines = [];
        foreach ($errors as $errorEntry) {
            $line = $errorEntry['line'];
            foreach ($errorEntry['errors'] as $field => $messages) {
                $lines[] = ConsoleStyle::apply("Error in line - $line, column - $field", ['RED']);
                $lines = array_merge($lines, $messages);
                $lines[] = "/br";
            }
        }

        array_pop($lines);
        TextTable::displayText($lines);
    }

}