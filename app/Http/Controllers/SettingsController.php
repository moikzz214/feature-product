<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Client Organization
     */
    public function getOrgUsers($id)
    {
        $users = User::where('company_id', $id)->orderBy('created_at', 'desc')->get();
        return response()->json($users, 200);
    }

    public function deleteOrgUser($id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $user->delete();
        return response()->json([
            'message' => 'User has been deleted',
        ], 200);
    }
    public function updateOrgUser(Request $request, $id)
    {
        $this->hasOneAdmin();
        $user = User::where('id', $id)->firstOrFail();
        $user->update($this->validateRequest());
        return response()->json([
            'message' => 'User has been updated',
        ], 200);
    }

    public function validateRequest()
    {
        return request()->validate([
            'name' => ['required', 'min:1', 'max:50', 'string'],
            'email' => ['sometimes', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => [''],
            'role' => ['integer'],
        ]);

    }

    public function hasOneAdmin()
    {
        $user = Auth::user();
        $check = User::where([
            'company_id' => $user->company_id,
            'role' => 3,
        ])->get();

        if($check->count() < 1 ){
            return false;
        }
        return true;
    }
}
