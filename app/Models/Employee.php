<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'employee';

    protected $fillable = [
        'id',
        'user_id',
        'establishment_id',
        'registration',
        'name',
        'email',
        'active',
        'admin',
        'email_verified_at',
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
