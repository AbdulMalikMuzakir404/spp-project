<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class loginSiswaController extends Controller
{
    // login user
    public function login(Request $request)
    {
        //validate fields
        $attrs = $request->validate([
            'nisn' => 'required|string|min:5|max:15',
            'password' => 'required|min:6|max:30|string'
        ]);

        // attempt login
        if(!Auth::attempt($attrs))
        {
            return response([
                'message' => 'Invalid credentials.'
            ], 403);
        }

        //return user & token in response
        return response([
            'user' => auth()->user(),
            'token' => auth()->user()->createToken('secret')->plainTextToken
        ], 200);
    }

    // logout user
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Logout success.'
        ], 200);
    }
}