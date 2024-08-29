<?php

class CSVImport
{
    public static function import(string $filePath, $modelClass, Validator $validator = null): array
    {
        $importColumns = $modelClass::importColumns();
        if (($handle = fopen($filePath, 'r')) !== false) {
            $data = [];
            $errors = [];
            $headers = fgetcsv($handle);
            $lineNumber = 1;

            if (!$headers) {
                fclose($handle);
                return [
                    'error' => ['CSV file is empty or headers are missing!']
                ];
            }

            $columnIndex = [];
            foreach ($importColumns as $modelField => $csvHeader) {
                $index = array_search($csvHeader, $headers);
                if ($index === false) {
                    fclose($handle);
                    return [
                        'error' => ["CSV header '$csvHeader' not found!"]
                    ];
                }
                $columnIndex[$modelField] = $index;
            }

            while (($row = fgetcsv($handle)) !== false) {
                $modelData = [];
                foreach ($columnIndex as $modelField => $index) {
                    $modelData[$modelField] = $row[$index] ?? null;
                }

                if ($validator) {
                    if ($validator->validate($modelData)) {
                        $data[] = $modelData;
                    } else {
                        $errors[] = [
                            'line' => $lineNumber,
                            'errors' => $validator->getErrors()
                        ];
                    }
                } else {
                    $data[] = $modelData;
                }

                $lineNumber++;
            }

            fclose($handle);

            if (!empty($errors)) {
                return [
                    'error' => $errors
                ];
            }

            return [
                'data' => $data
            ];

        } else {
            return [
                'error' => ['Error opening the file!']
            ];
        }
    }
}
