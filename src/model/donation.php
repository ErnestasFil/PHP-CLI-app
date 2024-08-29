<?php

class Donation extends Model
{
    public $id;
    public $donor_name;
    public $amount;
    public $charity_id;
    public $date_time;
    protected $table = 'donations';

//     public function __construct($donor_name = null, $amount = null, $charity_id = null)
//     {
//         parent::__construct();
//         $this->donor_name = $donor_name;
//         $this->amount = $amount;
//         $this->charity_id = $charity_id;
//         $this->date_time = date('Y-m-d H:i:s');
//     }
// }
}