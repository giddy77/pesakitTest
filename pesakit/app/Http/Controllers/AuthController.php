<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'phone' => 'required',
            'password' => 'required|string'//confirms the password from the user
        ]);

       $user = User::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'phone'=>$fields['phone'],
            'password'=>bcrypt($fields['password'])
        ]);

        $token = $user->createToken('pesakittoken')->plainTextToken;//create the token

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }


    //create a login function

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        //email check
        $user = User::where('email', $fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response(['message' => 'your credentials do not match our records'],401); //if the credentials do not match the records return
            //  status code of 401.Unauthorized
        }

        // $token = $user->createToken('pesakittoken')->plainTextToken;//create the token

        // $response = [
        //     'message' =>'logged in successfully',
        //     'user' => $user,
        //     'token' => $token,
        // ];

        // return response($response, 201);

        if ($user->hasRole('admin')) {
            return view('admin.dashboard');
        }

        return response(['message' => 'user logged in']);
    }


    //creaete a logout function to delete the token coz they get stored in the database

    public function logout(Request $request)
    {
        if (auth()->check()) {
            auth()->user()->tokens()->delete();
            return response(['message' => 'logged out successfully']);
        } else {
            return response(['message' => 'not authenticated']);
        }
    }
}
