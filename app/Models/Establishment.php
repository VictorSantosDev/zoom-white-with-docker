<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Establishment extends Model
{
    use HasFactory, SoftDeletes;

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

    public function address(): HasMany
    {
        return $this->hasMany(Address::class, 'establishment_id', 'id');
    }
}
