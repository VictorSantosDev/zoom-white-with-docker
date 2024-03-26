<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupons extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'coupons';

    protected $fillable = [
        'id',
        'establishment_id',
        'name_by_company',
        'opening_hours_start',
        'opening_hours_end',
        'days_of_the_week_start',
        'days_of_the_week_end',
        'info',
        'active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
