<?php

class Charity extends Model
{
    public $id;
    public $name;
    public $email;
    protected $table = 'charities';
    protected $primaryKey = 'id';

}
