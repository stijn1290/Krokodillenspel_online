<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function sendRequest($id)
    {
        $recipient = User::findOrFail($id);

        if (Auth::id() === $recipient->id) {
            return response()->json(['message' => 'You cannot add yourself'], 400);
        }

        Auth::user()->friendsOfMine()->syncWithoutDetaching([
            $recipient->id => ['status' => 'pending']
        ]);

        return "Hello";
    }

    public function acceptRequest($id)
    {
        $sender = User::findOrFail($id);

        Auth::user()->friendOf()->updateExistingPivot($sender->id, [
            'status' => 'accepted'
        ]);

        return "Hello";
    }

    public function declineRequest($id)
    {
        $sender = User::findOrFail($id);

        Auth::user()->friendOf()->updateExistingPivot($sender->id, [
            'status' => 'declined'
        ]);

        return "Hello";
    }

    public function removeFriend($id)
    {
        $user = User::findOrFail($id);

        Auth::user()->friendsOfMine()->detach($user->id);
        Auth::user()->friendOf()->detach($user->id);

        return "Hello";
    }

    public function myFriends()
    {
        return response()->json(Auth::user()->friends());
    }
}
