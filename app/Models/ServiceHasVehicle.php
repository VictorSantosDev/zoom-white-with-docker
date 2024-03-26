<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceHasVehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'service_has_vehicle';

    protected $fillable = [
        'id',
        'service_id',
        'vehicle_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
