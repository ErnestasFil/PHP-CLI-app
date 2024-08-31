<?php

class Donation extends Model
{
    public $id;
    public $donor_name;
    public $amount;
    public $charity_id;
    public $date_time;
    protected string $table = 'donations';

    public static function importColumns(): array
    {
        return [
            'donor_name' => 'donor_name',
            'amount' => 'amount',
            'charity_id' => 'charity_id',
            'date_time' => 'date_time',
        ];
    }
// }
}