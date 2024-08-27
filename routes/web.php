<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function() {

    Route::get('/karbaran', 'karbaran')->middleware('auth');

    Route::get('/dashboard', 'dashboard')->middleware('auth');

    Route::get('/payamresan/{id_to}', 'payamresan')->middleware('auth')->name('payamresan');

    Route::post('/ersal/payam', 'ersalPayam')->middleware('auth');

    Route::get('/chats', 'chats')->middleware('auth');

});

Route::get('/', function () {

    return view('chat');

})->name('chat');

Route::get('/chat/login', [ChatController::class, 'chatLogin'])->name('chat.login');

Route::post('/login', [ChatController::class, 'login'])->name('login');

Route::get('/users', function() {

    $users = DB::table('users')
    ->select(['*'])
    ->where('active', 'yes')
    ->get();

    $users = json_decode($users, true);

    $result = [];

    for($i = 0; $i < count($users); $i++)
    {
        $result[] = $users[$i]['mobile_number'];
    }

    $count = 12;

    // broadcast(new Record($result));

    return view('users', compact('users'));

})->name('users');

Route::get('/user/{mobile}', function($mobile) {

    $user = User::where('mobile_number', $mobile)->first();

    $chats = DB::table('chats')
    ->select(['*'])
    ->where('from', $mobile)
    ->get();

    $chats = json_decode($chats, true);

    return view('user', compact('chats', 'mobile'));

})->name('user');

Route::post('/chat/send-message', [ChatController::class, 'store'])->name('chat.send');

Route::post('/send', [ChatController::class, 'send']);




