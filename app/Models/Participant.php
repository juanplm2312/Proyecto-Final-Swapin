<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = ['raffle_id', 'name', 'email'];

    public function raffle()
    {
        return $this->belongsTo(Raffle::class);
    }

    public function assignment()
    {
        return $this->hasOne(Assignment::class, 'giver_id');
    }
}
