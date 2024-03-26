<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WashingVehicleHasWashing extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'washing_vehicle_has_washing';

    protected $fillable = [
        'id',
        'washing_vehicle_id',
        'washing_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
