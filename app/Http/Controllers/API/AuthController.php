<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected function register(StoreUpdateUser $request)
    {
        // $data = $request->validate([
        //     'user.name' => ['required', 'string', 'max:255'],
        //     'user.email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        //     'user.password' => ['required', 'string', 'min:1', 'confirmed'],
        //     'user.roles' => ['required'],
        // ]);

        $user = new User();
        $user->name = $request->input('user.name');
        $user->email = $request->input('user.email');
        $user->password = Hash::make($request->input('user.password'));
        $user->save();

        $user->assignRole($request->input('user.roles'));       

        $roles = $user->getRoleNames();
        $token = $user->createToken('libraryToken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json([
            'summary' => 'success',
            'code' => '201',
            'data' => $response
        ], 201);
    }

    public function logout()
    {

        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:191'],
            'password' => ['required', 'string']
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response(['message' => 'invalid credentials'], 401);
        } else {
            $token = $user->createToken('libraryToken')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token,
            ];

            return response()->json([
                'summary' => 'success',
                'code' => '200',
                'data' => $response
            ], 200);
        }
    }
}
