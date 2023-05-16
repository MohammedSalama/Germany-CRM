<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\NoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * CRUD CUSTOMER
 */
Route::get('customers/{id}',[CustomerController::class,'show']);
Route::patch('customers/{id}',[CustomerController::class,'update']);
Route::delete('customers/{id}',[CustomerController::class,'delete']);
Route::post('customers',[CustomerController::class,'create']);
Route::get('customers',[CustomerController::class,'index']);

/**
 * CRUD NOTES
 */
Route::get('customers/{customerId}/notes/{id}',[NoteController::class,'show']);
Route::patch('customers/{customerId}/notes/{id}',[NoteController::class,'update']);
Route::delete('customers/{customerId}/notes/{id}',[NoteController::class,'delete']);
Route::post('customers/{customerId}/notes',[NoteController::class,'create']);
Route::get('customers/{customerId}/notes',[NoteController::class,'index']);


