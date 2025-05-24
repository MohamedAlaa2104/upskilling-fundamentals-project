<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users,email',
        //     'password' => 'required',
        // ]);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
                'success' => true,
                'message' => 'User created successfully',
                'user' => $user,
            ],201);
    }

    public function login(Request $request)
    {
        //make data required (email, password)
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }



        //Check if user exists in database
        //Return Builder object
        // $user = User::where('email', $request->email);


        //Return collection object
        // $user = User::where('email', $request->email)->get();
        // dd($user[0]->name);

        // Return first object from the model
        $user = User::where('email', $request->email)->first();


        if (!$user){
            return response()->json([
                'success' => false,
                'message' => 'Credentials are not valid',
            ], 401);
        }  


        //Check if password is correct
        // dd($request->password, $user->password, Hash::check($request->password, $user->password));

        if(!Hash::check($request->password, $user->password)){
            return response()->json([
                'success' => false,
                'message' => 'Credentials are not valid',
            ], 401);
        };

        //Generate token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user,
        ], 200);
        
    }
}