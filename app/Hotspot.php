<?php

namespace App;

use App\Item;
use App\Hotspot_setting;
use Illuminate\Database\Eloquent\Model;

class Hotspot extends Model
{
    protected $guarded = [];

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    public function hotspot_settings()
    {
        return $this->hasMany(Hotspot_setting::class);
    }
}
