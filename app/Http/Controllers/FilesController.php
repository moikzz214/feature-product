<?php

namespace App\Http\Controllers;

use App\User_file;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Collection;
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

        // $this->validate($request, [
        //     'title' => 'required',
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        // $userId = auth()->id();
        $fileArray = array();
        $userStorage = '/uploads/user-'.auth()->id();
        if( !Storage::exists($userStorage) ){
            Storage::makeDirectory($userStorage, 0777, true);
        }

        // Wrap the files to collection
        $images = Collection::wrap(request()->file('file'));

        // Do something on each files uploaded
        $images->each( function($image, $key) use(&$userStorage){
            $userStorageDir = storage_path(). '/app'.$userStorage;
            $fileName = $image->getClientOriginalName();
            // $fname = $image->getClientOriginalName();
            // $name = pathinfo($fname, PATHINFO_FILENAME);
            // $fileName = substr($name,0,6).'-'.auth()->id().'-'.$randomName;
            $extn = $image->getClientOriginalExtension();
            // $imageExtensions = array('jpeg','jpg','png','JPEG','JPG','PNG');
            $jpgExtensions = array('jpeg','jpg','JPEG','JPG');
            // $img = Image::make($image)->fit(3840,2160); // UHD
            $img = Image::make($image)->fit(1920,1080); // FHD
            if( in_array($extn, $jpgExtensions) ){
                $img->encode('jpg', 100);
                // Image::make($image)->resize(100, 100, function ($constraint) {
                    //     $constraint->aspectRatio();
                    //     $constraint->upsize();
                    // })->save($userStorageDir.'/'.$fileName);

                    // Resize Image
                    // Image::make($image)->resize(100, 100, function ($constraint) {
                        //     $constraint->aspectRatio();
                        // });

                        // Moving the file to the created directory
                        // $image->move($userStorageDir, $fileName);
            }

            $img->save($userStorageDir.'/'.$fileName);

            // Add the files to message object
            $fileArray[$key]['path'] = $fileName;
            // $fileArray[$key]['extension'] = $extn;
            // $fileArray[$key]['mime'] = $image->getClientMimeType();
        });


        // Prepare object before saving

        // Save the files to user_files table

        // Return response
        return response()->json([
            'images' => $images
        ], 200);
    }

    public function getItemImages()
    {
        $files = User_file::where(['user' => 1, 'file_type' => 'image'])->take(50)->get();
        return response()->json($files, 200);
    }

    public function showImage($path)
    {
        $m = User_file::where('path', $path)->firstOrFail();
        if( isset($m) ){
            $image = storage_path(). '/uploads/user-1/1/'.$path;
            return response()->file($image, array('Content-Type' => 'image/jpeg'));
        }else{
            return abort('403');
        }
    }
}
