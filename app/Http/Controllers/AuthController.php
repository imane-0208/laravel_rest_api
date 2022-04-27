<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $cred = ['email' => $request->email, 'password' => $request->password];
        if(auth()->attempt($cred)){
            $user = auth()->user();
            return response()->json([ 'data' => ['token' => $user->createToken('api-token')->plainTextToken , 'user'=> $user] , 'status' => 'success', 'message' => 'Login Successful']);
        } else {
            return response()->json([ 'data' => [] , 'status' => 'error', 'message' => 'Login Failed']);
        }
    }

    function logout (Request $request){
        $user = auth()->user();
        if($user->Tokens()->delete()){
            return response()->json([ 'data' => [] , 'status' => 'success', 'message' => 'Logout Successful']);
        } else {
            return response()->json([ 'data' => [] , 'status' => 'error', 'message' => 'Logout Failed']);
        }
    }
}
