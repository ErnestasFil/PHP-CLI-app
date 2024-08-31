<?php

class Charity extends Model
{
    public int $id;
    public string $name;
    public string $email;
    protected string $table = 'charities';

    public static function importColumns(): array
    {
        return [
            'name' => 'name',
            'email' => 'email'
        ];
    }
}
