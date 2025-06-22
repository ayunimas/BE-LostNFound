<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasFactory;

    protected $table = "user";

    protected $fillable = [
        "id",
        "name",
        "contact",
        "email",
        "password",
        "id_role",
    ];

    public function Lost()
    {
        return $this->hasMany(Lost::class);
    }

    public function Found()
    {
        return $this->hasMany(Found::class);
    }

    public function Identity()
    {
        return $this->hasOne(Identity::class);
    }

    public function Pickup()
    {
        return $this->hasMany(Pickup::class);
    }

    public function Role()
    {
        return $this->belongsTo(Role::class, "id_role");
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
