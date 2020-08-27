<?php

namespace App;

use App\Item;
use Illuminate\Database\Eloquent\Model;

class User_file extends Model
{
    protected $guarded = [];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
