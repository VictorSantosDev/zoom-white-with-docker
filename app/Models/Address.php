<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'address';

    protected $fillable = [
        'id',
        'user_id',
        'establishment_id',
        'company_id',
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
