<?php

class ConsoleInput
{
    public static function getDataInput(array $variables, array $defaultValues = null): array
    {
        $receivedData = [];
        foreach ($variables as $key => $message) {
            echo $message;
            if (!empty($defaultValues[$key]))
                echo '(default value: ' . $defaultValues[$key] . ') ';

            $receivedData[$key] = trim(fgets(STDIN));

            if (!empty($defaultValues[$key]) && empty($receivedData[$key]))
                $receivedData[$key] = $defaultValues[$key];
        }
        return $receivedData;
    }

}
