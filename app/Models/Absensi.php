<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absensi extends Model
{
    use HasFactory;
    protected $table = "absensis";
    protected $primaryKey = "absensiId";
    protected $fillable = [
        "santriId",
        "matpelId",
        "statusId",
        "typeId",
        "date",
        "description",
    ];

    public function santri(): BelongsTo
    {
        return $this->belongsTo(Santri::class, "santriId", "santriId");
    }

    public function matpel(): BelongsTo
    {
        return $this->belongsTo(Matpel::class, "matpelId", "matpelId");
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, "statusId", "statusId");
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class, "typeId", "typeId");
    }
}
