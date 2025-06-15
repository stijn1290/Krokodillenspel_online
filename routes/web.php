<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FriendController;
use Illuminate\Support\Facades\Auth;
use \App\Http\Controllers\GameController;

Route::get('/', function () {
    $user = Auth::user();
    $friends = $user ? $user->friends() : collect(); // if logged in

    return view('welcome', compact('friends'));
})->name('home');
use App\Models\User;

Route::get('/users', function () {
    $users = User::where('id', '!=', Auth::id())->get();
    $sentRequests = Auth::user()->friendsOfMine()->pluck('friend_id')->toArray();
    $receivedRequests = Auth::user()->friendOf()->pluck('user_id')->toArray();
    $friends = Auth::user()->friends()->pluck('id')->toArray();

    return view('users', compact('users', 'sentRequests', 'receivedRequests', 'friends'));
})->middleware('auth');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('game', 'App\Http\Controllers\GameController');
    Route::post('/friend-request/{id}', [FriendController::class, 'sendRequest']);
    Route::post('/friend-accept/{id}', [FriendController::class, 'acceptRequest']);
    Route::post('/friend-decline/{id}', [FriendController::class, 'declineRequest']);
    Route::delete('/friend-remove/{id}', [FriendController::class, 'removeFriend']);
    Route::get('/friends', [FriendController::class, 'myFriends']);
});
Route::resource('game', 'App\Http\Controllers\GameController');

require __DIR__.'/auth.php';
Route::get('/match/{tooth}', [GameController::class, 'pressTooth'])->name('match.presstooth');
Route::resource('leaderboard', 'App\Http\Controllers\LeaderboardController');
