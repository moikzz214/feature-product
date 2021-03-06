<?php

namespace App\Http\Controllers;

use App\Item;
use App\Media_file;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Images
     * https://drive.google.com/drive/folders/1aaI4LEJKpWq1paURHcrIeXnJrGUb6JcG
     */

    public function upload(Request $request)
    {
        // Validate request
        // $this->validate($request, [
        //     'file' => 'required|image|mimes:jpeg,png,jpg|max:204800',
        // ]);

        // Media_files table
        $userFiles = new Media_file;
        $itemsArray = array();
        $fileArray = array();

        $uploadKey = Carbon::now();
        // $uploadKey = "";
        // $uploadKey = Str::random();

        // $userId = auth()->id();
        $userStorage = '/public/uploads/user-' . auth()->id();
        if (!Storage::exists($userStorage)) {
            Storage::makeDirectory($userStorage, 0755, true);
        }

        // Wrap the files to collection
        $images = Collection::wrap(request()->file('file'));

        // Do something on each files uploaded
        $images->each(function ($image, $key) use (&$userStorage, &$itemsArray, &$fileArray, &$request, &$uploadKey) {
            $userStorageDir = storage_path() . '/app' . $userStorage;
            $fileName = $image->getClientOriginalName();
            $title = pathinfo($fileName, PATHINFO_FILENAME);
            $extn = $image->getClientOriginalExtension();
            // $fname = $image->getClientOriginalName();
            // $fileName = substr($name,0,6).'-'.auth()->id().'-'.$randomName;
            // $imageExtensions = array('jpeg','jpg','png','JPEG','JPG','PNG');
            $jpgExtensions = array('jpeg', 'jpg', 'JPEG', 'JPG');
            $pngExtensions = array('png', 'PNG');
            $format = 'jpg';
            if (in_array($extn, $pngExtensions)) {
                $format = 'png';
            }

            // $img = Image::make($image)->fit(3840,2160); // UHD
            $img = Image::make($image);
            // if ($request->item_type == "360") {
            //     // Optimize 360 images only
            //     $img->fit(1920, 1080);
            //     $img->encode($format, 50);
            // }
            $img->save($userStorageDir . '/' . $fileName); // FHD

            if ($request->add_items == 'true') {
                array_push($itemsArray, array(
                    'item_type' => $request->item_type,
                    'product_id' => $request->product,
                    'created_at' => $uploadKey,
                    'updated_at' => Carbon::now(),
                ));
            }

            // Prepare object before saving
            array_push($fileArray, array(
                'file_type' => 'image',
                'title' => $title,
                'original_name' => Str::slug($title, '-'),
                'disk' => 'uploads',
                'path' => $fileName,
                'user_id' => auth()->id(),
                'item_id' => null,
                'created_at' => Carbon::now(),
            ));
        });

        // Save to Items table
        if ($request->add_items == 'true') {
            Item::insert($itemsArray);
            $recentlySavedItems = Item::where([
                'product_id' => $request->product,
                'created_at' => $uploadKey,
            ])->get();

            // Prepare Media_files object before saving Set Connection
            foreach ($recentlySavedItems as $key => $item) {
                $fileArray[$key]['item_id'] = $item->id;
            }
        }

        // Save the files to Media_files table
        Media_file::insert($fileArray);

        // Get the files by name
        // $recentlySavedFiles = Media_file::whereIn('title', $fileNames )->get();

        // // Prepare items
        // $itemsArray = array();
        // foreach ($recentlySavedFiles as $file) {
        //     array_push($itemsArray, array(
        //         'item_type' => '360',
        //         'product_id' => $request->product,
        //         'Media_files_id' => $file->id,
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()
        //     ));
        // }

        // // Save to Items table
        // Item::insert($itemsArray);

        // Return response
        return response()->json([
            'message' => 'Upload Success',
        ], 200);
    }

    public function getItemImages()
    {
        $files = Media_file::where(['user_id' => 1, 'file_type' => 'image'])->take(50)->get();
        return response()->json($files, 200);
    }

    public function showImage($path)
    {
        $m = Media_file::where('path', $path)->firstOrFail();
        if (isset($m)) {
            $image = storage_path() . '/uploads/user-1/1/' . $path;
            return response()->file($image, array('Content-Type' => 'image/jpeg'));
        } else {
            return abort('403');
        }
    }

    public function getUserFilesByID($id)
    {
        $files = Media_file::where(['user_id' => 1])->orderBy('created_at', 'DESC')->paginate(200);
        return response()->json($files, 200);
    }
}
