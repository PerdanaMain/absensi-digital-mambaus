<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Matpel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'matpels';
    protected $primaryKey = 'matpelId';
    protected $fillable = [
        'name',
        'typeId',
        'guruId',
        'kelasId',
        "semester",
        'day',
        'time',
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'typeId', 'typeId');
    }

    public function guru(): BelongsTo
    {
        return $this->belongsTo(Guru::class, 'guruId', 'guruId');
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelasId', 'kelasId');
    }
    public function absensi(): HasMany
    {
        return $this->hasMany(Absensi::class, 'matpelId', 'matpelId');
    }
}
