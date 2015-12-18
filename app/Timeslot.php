<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timeslot extends Model
{

    use SoftDeletes;

    public function room() {
        # A Timeslot belongs to a room
        # Define an inverse one-to-many relationship.
        return $this->belongsTo('\App\Room');
    }
}
