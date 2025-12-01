<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = ['raffle_id', 'giver_id', 'receiver_id', 'sent'];

    public function raffle()
    {
        return $this->belongsTo(Raffle::class);
    }

    public function giver()
    {
        return $this->belongsTo(Participant::class, 'giver_id');
    }

    public function receiver()
    {
        return $this->belongsTo(Participant::class, 'receiver_id');
    }
}

