<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller
{
    /**
     * Store a new user
     *
     * @param Request $request
     * @return Response
     */
    public function register(Request $request)
    {
        // validate incoming request
        $this->validate($request, [
            'username' => 'required|string|unique:users',
            'password' => 'required|confirmed'
        ]);

        try {
            $user = new User;
            $user->username = $request->input('username');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);

            $user->save();

            // return successful response
            return response()->json(['user' => $user, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            // return error message
            return response()->json(['message' => 'User registration failed!', 409]);
        }
    }
}
