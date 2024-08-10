<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wali extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'walis';
    protected $primaryKey = 'waliId';
    protected $fillable = [
        'userId', 'name', 'address', 'phone', "created_at", "updated_at",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId', 'userId');
    }
}