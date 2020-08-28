<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    public function getItemsByProduct($id)
    {
        $items = Item::where('product_id', $id)->with('user_file')->get();

        return response()->json([
            'items' => $items,
        ], 200);
    }

}
