<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pickup extends Model
{
    use HasFactory;

    protected $table = "pickup_request";

    protected $fillable = ["id", "status", "id_found", "id_person"];

    public function Found()
    {
        return $this->belongsTo(Found::class, "id_found");
    }

    public function Identity()
    {
        return $this->belongsTo(Identity::class, "id_person");
    }
}
