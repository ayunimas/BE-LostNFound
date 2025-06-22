<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pickup extends Model
{
    use HasFactory;

    protected $table = 'pickup_request';

    protected $fillable = [
        'id', 'date_req', 'status', 'id_found', 'id_person', 'id_user'
    ];

    public function userName()
    {
        return $this->belongsTo(User::class,'id_user');
    }

    public function Found()
    {
        return $this->belongsTo(Found::class,'id_found');
    }

    public function Identity()
    {
        return $this->belongsTo(Identity::class,'id_person');
    }


}
