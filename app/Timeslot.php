<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timeslot extends Model
{
    public function room() {
        # A Timeslot belongs to a room
        # Define an inverse one-to-many relationship.
        return $this->belongsTo('\App\Room');
    }
}
