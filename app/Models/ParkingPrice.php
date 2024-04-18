<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParkingPrice extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'parking_price';

    protected $fillable = [
        'id',
        'establishment_id',
        'price_daily',
        'price_by_hour',
        'charge_every_hour',
        'price_per_hour',
        'has_other_night_price',
        'price_by_hour_night',
        'start_of_additional',
        'end_of_additional',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
