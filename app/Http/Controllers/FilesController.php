<?php

namespace App\Http\Controllers;

use App\User_file;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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