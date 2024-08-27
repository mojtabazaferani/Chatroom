<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/dashboard', function() {

    $user = Auth::user();

    return $user;

})->middleware('auth');

Route::post('/chat/send-message', [ChatController::class, 'store'])->name('chat.send');

Route::post('/login', [ChatController::class, 'login'])->name('login');

Route::post('/ersal/payam', [UserController::class, 'ersalPayam'])->middleware('auth');

Route::controller(UserController::class)->group(function() {

    Route::post('/verify', 'verify')->name('verify');

    Route::post('/verify/code', 'verifyCode')->name('verify.code'); 

    Route::post('/register/applicant', 'registerApplicant')->name('register.applicant')->middleware('auth:sanctum');

    Route::post('/send/message/{mobile}', 'sendMessage')->middleware('auth:sanctum');

    Route::post('/send', 'send');

});