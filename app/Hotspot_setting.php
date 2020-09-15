<?php

namespace App;

use App\Hotspot;
use Illuminate\Database\Eloquent\Model;

class Hotspot_setting extends Model
{
    protected $guarded = [];

    public function hotspot()
    {
        return $this->belongsToMany(Hotspot::class);
    }
}
