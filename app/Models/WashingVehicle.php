<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WashingVehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'washing_vehicle';

    protected $fillable = [
        'id',
        'establishment_id',
        'employee_id',
        'plate',
        'model',
        'color',
        'price',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
