<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasUuids, HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'pin',
        'role_id',
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    public function intentions() {
        return $this->hasMany(Intention::class);
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin() {
        return $this->role->role_name === "admin";
    }

    public function hasRole(string $roleName) {
        return $this->role && $this->role->role_name === $roleName;
    }
}
