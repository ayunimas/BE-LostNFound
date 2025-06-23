<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identity extends Model
{
    use HasFactory;

    protected $table = "identity_person";

    protected $fillable = [
        "id",
        "cat_identity",
        "name",
        "image_path",
        "id_user",
    ];

    public function userName()
    {
        return $this->belongsTo(User::class, "id_user");
    }

    public function Pickup()
    {
        return $this->hasMany(Pickup::class);
    }
}
