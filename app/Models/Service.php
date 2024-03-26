<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'service';

    protected $fillable = [
        'id',
        'establishment_id',
        'category_id',
        'name',
        'price',
        'active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
