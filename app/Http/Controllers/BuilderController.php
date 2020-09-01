<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class BuilderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('builder.index');
    }

    public function edit($id)
    {
        $product = Product::where('id', '=', $id)->firstOrFail();
        if($product){
            return view('builder.index');
        }
        return abort(404);
    }
}
