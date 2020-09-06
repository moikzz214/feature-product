<?php

namespace App\Http\Controllers;

use App\Hotspot;
use Illuminate\Http\Request;

class HotspotsController extends Controller
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

    public function allHostspotsByProductId($id)
    {
        $hotspots = Hotspot::where('product_id', $id)->get();
        return response()->json($hotspots, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $this->validateScenes();
        $hotspot = Hotspot::create([
            'title' => $request['title'],
            'product_id' => $request['product_id'],
        ]);
    }

    public function setHotspot(Request $request)
    {
        $hotspot = Hotspot::create([
            'title' => $request['title'],
            'product_id' => $request['product_id'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $hotspot = Hotspot::where('id', '=', $id)->firstOrFail();
        $hotspot->update();
        return response()->json([
            'hotspot' => $hotspot,
            'message' => 'Hotspot has been updated',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function validateScenes()
    {
        return request()->validate([
            'title' => ['required', 'min:1', 'max:50', 'string'],
            'product_id' => ['required'],
        ]);
    }
}
