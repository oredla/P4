<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function room() {
        # A reservation belongs to a room
        # Define an inverse one-to-many relationship.
        return $this->belongsTo('\App\Room');
    }
}
