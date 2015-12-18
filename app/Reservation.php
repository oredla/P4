<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes;

    public function room() {
        # A reservation belongs to a room
        # Define an inverse one-to-many relationship.
        return $this->belongsTo('\App\Room');
    }

    public function user() {
        # A reservation belongs to a room
        # Define an inverse one-to-many relationship.
        return $this->belongsTo('\App\User');
    }
}
