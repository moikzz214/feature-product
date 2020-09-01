<?php

namespace App\Http\Controllers;

use App\Item;
use App\Media_file;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getItemsByProduct($id)
    {
        $items = Item::where('product_id', $id)->with('media_file')->get();

        return response()->json([
            'items' => $items,
        ], 200);
    }

    public function destroy($id)
    {

        $item = Item::where('id', '=', $id)->firstOrFail();
        $item->delete();

        $file = Media_file::where('item_id', '=', $id)->firstOrFail();
        $file->update(['item_id' => null]);

        return response()->json('Item has been deleted', 200);
    }

    public function replace($data)
    {
        // Decode string
        $requestData = json_decode($data, true);
        
        // Check file Media_file id if exist
        $selectedFile = Media_file::where('id', '=', $requestData['selected'])->firstOrFail();
        
        // Check if already assigned
        if($selectedFile->item_id != null){
            // Return error response
            return response()->json([
                'status' => 'error',
                'message' => 'The selected file is already assigned to other item'
            ], 200);
        }

        // Set the original to null
        $originalFile = Media_file::where('item_id', '=', $requestData['item'])->firstOrFail();
        $originalFile->update(['item_id' => null]);

        // Update item_id value
        $selectedFile->update(['item_id' => $requestData['item']]);

     
        // Return response
        return response()->json([
            'status' => 'success',
            'message' => 'Item has been updated'
        ], 200);
    }

}
