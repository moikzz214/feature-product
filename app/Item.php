<?php

namespace App;

use App\Product;
use App\User_file;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function user_file()
    {
        return $this->hasOne(User_file::class);
    }
}
