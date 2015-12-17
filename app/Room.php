<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function timeslot() {
        # Room has many Timeslots
        # Define a one-to-many relationship.
        return $this->hasMany('\App\Timeslot');
    }

    public function reservation(){
        # Room has many Reservations
        # Define a one-to-many relationship.
        return $this->hasMany('\App\Reservation');
    }
}
