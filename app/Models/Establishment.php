<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    use HasFactory;

    protected $table = 'establishments';

    protected $fillable = [
        'id',
        'user_id',
        'name_by_company',
        'document',
        'type',
        'cor_system',
        'active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
