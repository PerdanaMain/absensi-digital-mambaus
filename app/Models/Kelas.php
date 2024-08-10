<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'kelas';
    protected $primaryKey = 'kelasId';
    protected $fillable = [
        'name', "created_at", "updated_at",
    ];
}
