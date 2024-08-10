<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pengurus extends Model
{
    use HasFactory;
    protected $table = 'penguruses';
    protected $primaryKey = 'pengurusId';
    protected $fillable = [
        'userId', 'name', 'address', 'phone', "created_at", "updated_at",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId', 'userId');
    }

    public function santris(): HasMany
    {
        return $this->hasMany(Santri::class, 'pengurusId', 'pengurusId');
    }
}