<?php

namespace App\Http\Controllers;

use App\Item;
use App\Hotspot;
use App\Hotspot_setting;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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

    // Pivot table of Hotspot and Item
    // https://laraveldaily.com/pivot-tables-and-many-to-many-relationships/
    public function applyHotspot(Request $request)
    {
        // Decode Settings
        $settingsToSet = json_decode($request->hotspot_settings);

        // Prepare Settings
        $toUpdateSettings = array();
        $toInsertSettings = [];
        $settingIds = [];

        $updatedMsg = 'No settings were updated';
        foreach ($settingsToSet as $key => $value) {
            // Check each setting if already exist
            $check = Hotspot_setting::where([
                'item_id' => $value->itemID,
                'hotspot_id' => $value->hotspotsID,
            ])->first();

            // To update array - If already exist
            if ($check) {
                // Update
                array_push($toUpdateSettings, array(
                    'item_id' => $check->item_id,
                    'hotspot_id' => $check->hotspot_id,
                    'hotspot_settings' => json_encode($value->hotspotSettings),
                    'created_at' => Carbon::now(),
                ));

            } else {
                // To insert - If new record
                array_push($toInsertSettings, array(
                    'item_id' => $value->itemID,
                    'hotspot_id' => $value->hotspotsID,
                    'hotspot_settings' => json_encode($value->hotspotSettings),
                    'created_at' => Carbon::now(),
                ));
            }
        }

        // Uses Transactions
        DB::beginTransaction();
            // do all your updates here
            foreach ($toUpdateSettings as $toUpdate) {
                DB::table('hotspot_settings')->where([
                    'item_id' => $toUpdate['item_id'],
                    'hotspot_id' => $toUpdate['hotspot_id'],
                ])
                    ->update(['hotspot_settings' => $toUpdate['hotspot_settings']]);
            }
            // when done commit
        DB::commit();

        // Insert to DB
        $hotspot_settings = Hotspot_setting::insert($toInsertSettings);

        // Return response
        return response()->json([
            'toupdate' => $toUpdateSettings,
            'updated' => $updatedMsg,
            'settings' => $hotspot_settings,
            // 'message' => 'Hotspot has been updated',
        ], 200);
    }

    /// Hotspot_settings
    // public function applyHotspot(Request $request)
    // {
    //     // Decode Settings
    //     $settingsToSet = json_decode($request->hotspot_settings);

    //     // Prepare Settings
    //     $toUpdateSettings = array();
    //     $toInsertSettings = [];
    //     $settingIds = [];

    //     $updatedMsg = 'No settings were updated';
    //     foreach ($settingsToSet as $key => $value) {
    //         // Check each setting if already exist
    //         $check = Hotspot_setting::where([
    //             'item_id' => $value->itemID,
    //             'hotspot_id' => $value->hotspotsID,
    //         ])->first();

    //         // To update array - If already exist
    //         if ($check) {
    //             // Update
    //             array_push($toUpdateSettings, array(
    //                 'item_id' => $check->item_id,
    //                 'hotspot_id' => $check->hotspot_id,
    //                 'hotspot_settings' => json_encode($value->hotspotSettings),
    //                 'created_at' => Carbon::now(),
    //             ));

    //         } else {
    //             // To insert - If new record
    //             array_push($toInsertSettings, array(
    //                 'item_id' => $value->itemID,
    //                 'hotspot_id' => $value->hotspotsID,
    //                 'hotspot_settings' => json_encode($value->hotspotSettings),
    //                 'created_at' => Carbon::now(),
    //             ));
    //         }
    //     }

    //     // Uses Transactions
    //     DB::beginTransaction();
    //         // do all your updates here
    //         foreach ($toUpdateSettings as $toUpdate) {
    //             DB::table('hotspot_settings')->where([
    //                 'item_id' => $toUpdate['item_id'],
    //                 'hotspot_id' => $toUpdate['hotspot_id'],
    //             ])
    //                 ->update(['hotspot_settings' => $toUpdate['hotspot_settings']]);
    //         }
    //         // when done commit
    //     DB::commit();

    //     // Insert to DB
    //     $hotspot_settings = Hotspot_setting::insert($toInsertSettings);

    //     // Return response
    //     return response()->json([
    //         'toupdate' => $toUpdateSettings,
    //         'updated' => $updatedMsg,
    //         'settings' => $hotspot_settings,
    //         // 'message' => 'Hotspot has been updated',
    //     ], 200);
    // }

    public function fetchSettings($id)
    {
        // Get Items first
        $items = Item::where('product_id', '=', $id)->get();
        $itemIds = array();
        foreach ($items as $value) {
            array_push($itemIds, $value->id);
        }
        // Get Hotspot Settings
        $hotspot_settings = Hotspot_setting::whereIn('item_id', $itemIds)->get();
        return response()->json([
            'settings' => $hotspot_settings,
            'message' => 'Hotspot has been fetched',
        ], 200);
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
        $hotspot->update($this->validateHotspot());
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

    public function validateHotspot()
    {
        return request()->validate([
            'title' => ['required', 'min:1', 'max:50', 'string'],
            'hotspot_type' => ['required'],
            'product_id' => ['required'],
            'content' => [''],
        ]);
    }
}
