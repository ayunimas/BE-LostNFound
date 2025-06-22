<?php

namespace App\Models;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Found extends Model
{
    use HasFactory;

    protected $table = 'found';

    protected $fillable = [
        'id', 'date_found', 'location', 'id_user'
    ];

    public function userName()
    {
        return $this->belongsTo(User::class,'id_user');
    }

    public function item()
    {
        return $this->morphOne(Item::class, 'itemable');
    }

    public function Pickup()
    {
        return $this->hasMany(Pickup::class);
    }
}
