<?php

class Charity extends Model
{
    public $id;
    public $name;
    public $email;
    protected string $table = 'charities';
    protected string $primaryKey = 'id';

    public static function importColumns()
    {
        return [
            'name' => 'name',
            'email' => 'email'
        ];
    }
}
