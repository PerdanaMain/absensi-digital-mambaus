<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    protected $table = 'users';
    protected $primaryKey = 'userId';
    protected $fillable = [
        'name',
        'username',
        'roleId',
        'image',
        'password',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'roleId', 'roleId');
    }

    public function guru(): HasOne
    {
        return $this->hasOne(Guru::class, 'userId', 'userId');
    }

    public function pengurus(): HasOne
    {
        return $this->hasOne(Pengurus::class, 'userId', 'userId');
    }

    public function wali(): HasOne
    {
        return $this->hasOne(Wali::class, 'userId', 'userId');
    }
}
