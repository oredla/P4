<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes;

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

    public static function roomsForDropdown() {
        $rooms = \App\Room::orderBy('room_name','ASC')->get();
        $rooms_for_dropdown = [];
        foreach($rooms as $room) {
            $rooms_for_dropdown[$room->id] = $room->room_name;
        }

        return $rooms_for_dropdown;
    }
}
