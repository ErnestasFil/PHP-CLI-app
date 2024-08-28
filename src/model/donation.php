<?php

class Donation extends Model
{
    public $id;
    public $donor_name;
    public $amount;
    public $charity_id;
    public $date_time;
    protected $table = 'donations';


}