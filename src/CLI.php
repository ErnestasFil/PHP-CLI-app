<?php

class CLI
{
    public static function getInput(): string
    {
        $python = 'python -c "exec(\'import msvcrt\nkey=msvcrt.getch()\nif key == b\"\\\\xe0\":\n    key += msvcrt.getch()\nprint(key)\')"';

        exec($python, $output);
        $str = preg_replace("/b'([^']*)'/", '$1', $output[0]);

        return match ($str) {
            '\r' => 'enter',
            '\xe0H' => 'up',
            '\xe0P' => 'down',
            default => '',
        };
    }

    public static function getSelectedFile(): ?string
    {
        $command = 'python -c "exec(\'import tkinter as tk\nfrom tkinter import filedialog\nroot=tk.Tk()\nroot.withdraw()\nfile_path=filedialog.askopenfilename(filetypes=[(\\"CSV files\\", \\"*.csv\\")])\nif file_path:\n    print(file_path)\')"';
        $output = [];
        exec($command, $output);

        if (isset($output[0])) {
            return trim($output[0]);
        }
        return null;
    }

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
