<?php

namespace App\Http\Controllers;

use App\Scene;
use Illuminate\Http\Request;

class ScenesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function scenesAll()
    {
        $scenes = Scene::paginate(20);
        return response()->json($scenes, 200);
    }

    public function store(Request $request)
    {
        // validate request
        $this->validateScenes();
        // store request
        $scene = Scene::create([
            'title' => $request->title,
            'type' => $request->type,
            'product' => $request->product
        ]);
        // response
        return response()->json([
            'scene' => $scene,
            'message' => 'Scene has been created',
        ], 200);
    }

    public function validateScenes()
    {
        return request()->validate([
            'title' => ['required', 'min:1', 'max:50', 'string'],
            'type' => ['required'],
            'product' => ['required'],
        ]);
    }
}
