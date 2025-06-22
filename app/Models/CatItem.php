<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatItem extends Model
{
    use HasFactory;

    protected $table = 'category_item';

    protected $fillable = [
        'id', 'nm_cat'
    ];

    public function item() {
        
        return $this->hasMany(Item::class);

    }
}
