<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
         
    }

    public function index()
    {
        $users = User::all();

        return response()->json([
            'success' => true,
            'message' => 'Users fetched successfully',
            'users' => $users,
        ], 200);
    }

    //crud operations
    public function store(\Illuminate\Http\Request $request)
    {
        $request->validate([
           'name' => 'required',
           'email' => 'required|email|unique:users,email',
           'role' => 'required|in:admin,user',
           'password' => 'required',
        ]);


//        $user = User::create($request->all());

        $userData = $request->only(['name', 'email', 'password', 'role']);

        $user = User::create($userData);

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'user' => $user,
        ], 201);
    }

    public function show($id)
    {
        $user = User::find($id);

        return response()->json([
            'success' => true,
            'message' => 'User fetched successfully',
            'user' => $user,
        ], 200);
    }

    public function update(\Illuminate\Http\Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,user',
            'password' => 'nullable',
        ]);

        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }

        // select * from users where id = $id;

//        $user = User::where('email', $id)->first();


//        $user->update([
//            'name' => $request->name,
//        ]);

        // $user->name = $request->name;

        // $user->save();

        // return $user;

        $user->update($request->only(['name', 'email', 'role', 'password']));

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'user' => $user,
        ], 200);
    }

    public function destroy($id)
    {
        $user = User::where('id', '>', 1)->find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully',
        ], 200);
    }
}

