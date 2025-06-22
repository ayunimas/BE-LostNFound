<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'item';

    protected $fillable = [
        'id','nm_item', 'color', 'brand', 'weight', 'itemable_type', 'itemable_id', 'id_catItem'
    ];

    public function catItem()
    {
        return $this->belongsTo(CatItem::class,'id_catItem');
    }

    public function itemable() 
    {
        return $this->morphTo();
    }

}
