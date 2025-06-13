<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Current_game extends Model
{
    protected $table = 'current_games';
    protected $fillable = [
        'player_id_1',
        'player_id_2'
    ];
    public function player1()
    {
        return $this->belongsTo(User::class, 'player_id_1');
    }
    public function player2()
    {
        return $this->belongsTo(User::class, 'player_id_2');
    }
}
