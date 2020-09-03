<?php

namespace App;

use App\Item;
use Illuminate\Database\Eloquent\Model;

class Hotspot extends Model
{
    protected $guarded = [];

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }
}
