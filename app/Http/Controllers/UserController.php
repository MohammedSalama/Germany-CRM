<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(Request $request)
    {
        /* $ip = $request->ip(); Dynamic IP address */
        $ip = '162.159.24.227'; /* Static IP address */
        $currentUserInfo = Location::get($ip);

        return view('location.user', compact('currentUserInfo'));
    }
}
