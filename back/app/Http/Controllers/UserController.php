<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }
    public function register(Request $request)
    {   
        $request->validate([
            'username' => 'required|max:50|regex:/^[a-zA-Z]/',
            'email' => 'required|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);
        
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'Message' => 'Created',
            'data' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)){
            return response()->json(['massage'=> 'Bad Login'], 404);
        }

        return response()->json([
            'Message' => 'Login successfully!',
            'data' => $user,
        ], 201);
    }
}
