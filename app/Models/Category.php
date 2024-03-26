<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'category';

    protected $fillable = [
        'id',
        'establishment_id',
        'name',
        'number_icon',
        'active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
