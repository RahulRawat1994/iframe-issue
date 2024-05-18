<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAccountDetails;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/authuser-profile', [UserAccountDetails::class, 'save'])->name('authuser.profile');
Route::delete('/authuser/delete', [UserAccountDetails::class, 'destory'])->name('authuser.delete');