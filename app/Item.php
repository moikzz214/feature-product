<?php

namespace App;

use App\Hotspot;
use App\Product;
use App\User_file;
use App\Media_file;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function hotspots()
    {
        return $this->belongsToMany(Hotspot::class);
    }
    public function media_file()
    {
        return $this->hasOne(Media_file::class);
    }
}
