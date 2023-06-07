<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**
 * Authentication
 */
Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => ['web']], function () {


    Route::get('/adminDashboard', function () {
        return view('Backend.adminDashboard');
    })->name('adminDashboard');


});



require __DIR__.'/auth.php';
