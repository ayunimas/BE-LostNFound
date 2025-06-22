<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifable;
    use HasFactory;

    protected $table = 'user';

    protected $fillable = [
        'id', 'name','contact','email','password','id_role'
    ];

    public function Lost() {
        
        return $this->hasMany(Lost::class);

    }

    public function Found() {
        
        return $this->hasMany(Found::class);

    }

    public function Identity() {
        
        return $this->hasOne(Identity::class);

    }

    public function Pickup()
    {
        
        return $this->hasMany(Pickup::class);

    }

}
