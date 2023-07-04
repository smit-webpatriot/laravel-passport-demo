<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validation
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        // Check validation
        if($validation->fails())
        {
            return response()->json([
                'status' => false,
                'message' => 'Validation error(s)',
                'errors' => $validation->errors(),
            ]);
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

             // Success Response
            return response()->json([
                'status' => true,
                'message' => 'Registed Successfully',
                'token' => $user->createToken('API Token')->accessToken,
                'user' => $user
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'false',
                'message' => 'Something went wrong',
            ], 500);
        }
    }

    public function login(Request $request)
    {
        // Validation
        $validation = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);

        // Check validation
        if($validation->fails())
        {
            return response()->json([
                'status' => false,
                'message' => 'Validation error(s)',
                'errors' => $validation->errors(),
            ]);
        }

        // Check credentials
        if(!auth()->attempt($request->only(['email', 'password'])))
        {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Credentials'
            ], 401);
        }

        /** @var \App\Models\User $user */
        $user = auth()->user();

        // Success Response
        return response()->json([
            'status' => true,
            'message' => 'Login Successfully',
            'token' => $user->createToken('API Token')->accessToken,
            'user' => $user
        ]);
    }

    public function logout()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        // Get the current token
        $token = $user->token();

        // Revoke the token
        $token->revoke();

        // Success Response
        return response()->json([
            'status' => true,
            'message' => 'Logout Successfully',
        ]);
    }

    public function logoutFromAll()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        // Get the all token associated with the user
        $tokens = $user->tokens;

        // iterate through all tokens and revoke them
        foreach($tokens as $token)
        {
            $token->revoke();
        }

        // Success Response
        return response()->json([
            'status' => true,
            'message' => 'Logout From All Successfully',
        ]);
    }
}

