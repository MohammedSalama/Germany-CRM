<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Crm\User\Requests\UserCreation;
use Crm\User\Services\UserService;
use http\Env\Response;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private UserService $userService;

    CONST TOKEN_NAME = 'personal';

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return void
     */
    public function create(UserCreation $request)
    {
        $user = $this->userService->create($request);
        return response()->json([
            'user' => $user,
            'token' => $user->createToken(self::TOKEN_NAME)->plainTextToken
        ]
    );

    }
}
