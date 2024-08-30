<?php

class Charity extends Model
{
    public $id;
    public $name;
    public $email;
    protected $table = 'charities';
    protected string $primaryKey = 'id';

    public static function importColumns()
    {
        return [
            'name' => 'name',
            'email' => 'email'
        ];
    }

    public static function create($data)
    {
        print_r($data);
    }

}
