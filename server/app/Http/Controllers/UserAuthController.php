<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    
    /**
    * Register a user on the database given an object .
    */
    public function register_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "errors" => $validator->errors()
            ]);
        }

        $inputsPassed = $request->input();

        $emailAlreadyRegistered = User::where('email', $inputsPassed['email'])->exists();

        if($emailAlreadyRegistered){
            return response()->json([
                "errors" => [
                    "email" => ["Email '$inputsPassed[email]' has been already registered."]
                ]
            ], 400);
        }
         
        $newUser = User::create([
            'name' => $inputsPassed['name'],
            'email' => $inputsPassed['email'],
            'password' => Crypt::encryptString($inputsPassed['password']),
        ]);

        return response()->json([
            'message' => "New user registered succesfully",
            'newUser' => $newUser
        ], 201);
    }
}
