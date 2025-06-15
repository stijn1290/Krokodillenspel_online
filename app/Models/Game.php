<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'games';
    protected $fillable = [
        'winner_id',
        'loser_id',
        'score_winner',
        'toothsPressedTotal'
    ];
    public function winner()
    {
        return $this->belongsTo(User::class, 'winner_id');
    }
    public function loser()
    {
        return $this->belongsTo(User::class, 'loser_id');
    }
}
