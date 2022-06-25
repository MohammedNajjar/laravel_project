<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function index() {
        return response()->json(['users'=>DB::table('users')->get()]);
    }

    public function show($id)
    {
        $user = User::with('tweets')->withCount('tweets')->find($id);
        return response()->json(['user'=>$user]);
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|string|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::create($input);

        return response()->json([
            'success' => true,
            'message' => 'User created successfully.',
            'data' => $user
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $input = $request->validate([
            'name' => 'required|string|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.'

            ], 404);
        }

        $user->update($input);

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully.',
            'data' =>  $user
        ], 200);
    }

    public function profile($id)
    {
        $user = User::with('tweet')->find($id);
        return response()->json(['data' => $user ]);

    }
}
