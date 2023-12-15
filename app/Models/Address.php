<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'address';

    protected $fillable = [
        'id',
        'user_id',
        'establishment_id',
        'postal_code',
        'street',
        'neighborhood',
        'state',
        'city',
        'number',
        'complement',
        'active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
