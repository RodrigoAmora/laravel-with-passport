<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller {

    public function register(Request $request) {
	    $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

	    $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => md5($request->password)
        ]);
 
        $token = $user->createToken('TutsForWeb')->accessToken;
 
        return response()->json(['redirect_uri' => 'https://www.google.com?token='.$token], 200);
	}

	public function login(Request $request) {
	    $user = User::where('email', $request->email)->first();

	    if ($user) {
	        if ($user->password == md5($request->password)) {
	            $token = $user->createToken('Laravel Password Grant Client')->accessToken;
	            $response = ['redirect_uri' => 'https://www.google.com?token='.$token, 'status' => 200,  'token' => $token];
	            // return response()->json($response);
	            return response($response, 200);
	            // return redirect()->away('https://www.google.com?token='.$token);
	        } else {
	            $response = "Password missmatch";
	            return response($response, 422);
	        }
	    } else {
	        $response = 'User does not exist';
	        return response($response, 422);
	    }
	}

	public function logout(Request $request) {
	    $token = $request->user()->token();
	    $token->revoke();

	    $response = 'You have been succesfully logged out!';
	    return response($response, 200);
	}
}
