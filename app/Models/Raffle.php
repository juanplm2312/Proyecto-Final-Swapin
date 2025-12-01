<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Raffle extends Model
{
    protected $fillable = ['user_id', 'name', 'description', 'status'];

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}
