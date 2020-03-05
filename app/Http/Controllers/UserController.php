<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    /**
     * Instantiate a new UserController instance
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get the authenticated user
     *
     * @return Response
     */
    public function profile()
    {
        return response()->json(['user' => Auth::user()], 200);
    }

    /**
     * REST Api: users/list
     * GET All users
     *
     * @return Reponse
     */
    public function list()
    {
        return response()->json(['users' => User::all()], 200);
    }

    /**
     * REST Api: users/show
     * GET All users
     *
     * @return Reponse
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);

            return response()->json(['user' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'user not found'], 404);
        }
    }
}
