<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::all();

        return $users;
    }

    //crud operations
    public function store(\Illuminate\Http\Request $request)
    {
//        $user = User::create([
//            'name' => $request->name,
//            'email' => $request->email,
//            'password' => Hash::make($request->password),
//            'role' => $request->role
//        ]);
//
//        dd($user);

        $request->validate([
           'name' => 'required',
           'email' => 'required',
           'password' => 'required',
        ]);


//        $user = User::create($request->all());

        $userData = $request->only(['name', 'email', 'password']);

        $userData ['role'] = 'user';

        $user = User::create($userData);

        dd($user);


    }

    public function show($id)
    {
        $user = User::find($id);

        return $user;

    }

    public function update(\Illuminate\Http\Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $user = User::find($id);

        // select * from users where id = $id;

//        $user = User::where('email', $id)->first();


//        $user->update([
//            'name' => $request->name,
//        ]);

        $user->name = $request->name;

        $user->save();

        return $user;
    }

    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return 'Deleted';
    }
}

