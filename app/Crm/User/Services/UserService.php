<?php

namespace Crm\User\Services;

use Crm\User\Models\User;
use Crm\User\Requests\UserCreation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{

    /**
     * @param UserCreation $request
     * @return User
     */
    public function create(UserCreation $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        event(new \Crm\User\Events\UserCreation($user));
        return $user;
    }

//    public function register(Request $request)
//    {
//        $fields = $request->validate([
//            'name' => 'required|string',
//            'email' => 'required|string|unique:users,email',
//            'password' => 'required|string|confirmed'
//        ]);
//
//        $user = User::create([
//            'name' => $fields['name'],
//            'email' => $fields['email'],
//            'password' => bcrypt($fields['password'])
//        ]);
//
//        $token = $user->createToken('myapptoken')->plainTextToken;
//
//        $response = [
//            'user' => $user,
//            'token' => $token
//        ];
//
//        return response($response , 201);
//    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged Out'
        ];
    }

    public function login(UserCreation $request)
    {
//        $fields = $request->validate([
////            'name' => 'required|string',
//            'email' => 'required|string',
//            'password' => 'required|string'
//        ]);
        /**
         * Check Email
         */
        $user = User::where('email' , $fields['email'])->first();

        /**
         * Check Password
         */
        if (!$user || !Hash::check($fields['password'], $user->password))
        {
            return response([
                'message' => 'Bad Creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response , 201);
    }
}
