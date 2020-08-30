<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getItemsByProduct($id)
    {
        $items = Item::where('product_id', $id)->with('user_file')->get();

        return response()->json([
            'items' => $items,
        ], 200);
    }

    public function destroy($id)
    {

        $item = Item::where('id', '=', $id)->firstOrFail();
        $item->delete();
        return response()->json('Item has been deleted', 200);
    }

}
