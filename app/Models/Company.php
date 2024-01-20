<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'company';

    protected $fillable = [
        'id',
        'establishment_id',
        'company_name',
        'fantasy_name',
        'document',
        'phone',
        'email',
        'closing_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
