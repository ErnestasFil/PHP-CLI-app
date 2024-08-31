<?php

class Donation extends Model
{
    public int $id;
    public string $donor_name;
    public float $amount;
    public int $charity_id;
    public string $date_time;
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
}