<?php

namespace Crm\User\Services;

use Crm\User\Models\User;
use Crm\User\Requests\UserCreation;
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
}
