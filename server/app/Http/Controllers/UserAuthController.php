<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    
    /**
    * Register a user on the database given an object with the keys: name, email and password.
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
            'password' => password_hash($inputsPassed['password'], PASSWORD_DEFAULT),
        ]);

        return response()->json([
            'message' => "New user registered succesfully",
            'newUser' => $newUser
        ], 201);
    }

    /**
    * Login a user given an object with the keys: email and password.
    */
    public function login_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "errors" => $validator->errors()
            ]);
        }

        $inputsPassed = $request->input();

        $emailNotFound = User::where('email', $inputsPassed['email'])->exists();
        if(!$emailNotFound){
            return response()->json([
                "errors" => [
                    "email" => ["Email '$inputsPassed[email]' is not registered on the system."]
                ]
            ], 400);
        }
        
        $userFounded = User::where('email', $inputsPassed['email'])->first();
        
        $passwordsMatches = password_verify($inputsPassed['password'], $userFounded->password);
        if (!$passwordsMatches) {
            return response()->json([
                "errors" => [
                    "password" => ["Password isn't correct."]
                ]
            ], 500);
        }

        // dd($userFounded->tokens);
        $accessToken = $userFounded->createToken('EnLaCuerdaFlojaToken');
        // dd($accessToken);
        $accessToken->expires_at = Carbon::now()->addMinutes(60*2);
        // $accessToken->save();


        // Puedes devolver el token en la respuesta JSON
        return response()->json([
            'message' => 'Login successful',
            'token' => $accessToken->plainTextToken,
        ]);
    }

    /**
    * Logout a user given authorization bearer token.
    */
    public function logout_user(Request $request){
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => "Logout succesfull!"
        ]);
    }
    /**
    * Checks the user owner of the given authorization bearer token
    */
    public function verify_token(Request $request){
        return $request->user();
    }
}
