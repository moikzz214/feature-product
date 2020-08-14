<?php

namespace App;

use App\Scene;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function scenes()
    {
        return $this->hasMany(Scene::class);
    }
}
