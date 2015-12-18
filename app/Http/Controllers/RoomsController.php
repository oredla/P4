<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoomsController extends Controller {

    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    /**
     * Responds to requests to GET /rooms
     */
    public function getRooms() {
        $rooms = \App\Room::orderBy('room_name', 'ASC')
                            ->with('timeslot')
                            ->with('reservation')
                            ->get();
        return view('rooms.list')->with('rooms', $rooms);
    }

    /**
     * Responds to requests to GET /rooms/reservations/all/{room_id}
     */
    public function getRoomsAllReservations($room_id){
        $reservations = \App\Reservation::with('room')
                                        ->with('user')
                                        ->where('room_id', $room_id)
                                        ->orderBy('start_time', 'ASC')
                                        ->orderBy('date_of_event','ASC')
                                        ->get();
        return view('rooms.reservationsList')->with('reservations', $reservations)
                                                ->with('room_id', $room_id);
    }

    /**
     * Responds to requests to GET /rooms/reservations/{room_id}
     */
    public function getRoomsUpcomingReservations($room_id){
        $reservations = \App\Reservation::with('room')
                                        ->with('user')
                                        ->where('room_id', $room_id)
                                        ->where('date_of_event', '>=', date(\Carbon\Carbon::now()))
                                        ->orderBy('date_of_event','ASC')
                                        ->orderBy('start_time', 'ASC')
                                        ->get();
        return view('rooms.reservationsList')->with('reservations', $reservations)
                                                ->with('room_id', $room_id);
    }

    /**
     * Responds to requests to GET /rooms/create
     */
    public function getRoomsCreate() {
        return view('rooms.create');
    }

    /**
     * Responds to requests to POST /rooms/create
     */
    public function postRoomsCreate(Request $request) {
        $this->validate($request,
            [
              'inputRoomName' => 'required',
              'inputRoomLocation' => 'required',
              'inputRoomMaxPpl' => 'required|integer',
            ]);

        $room = new \App\Room();
        $room->room_name = $request->inputRoomName;
        $room->room_location = $request->inputRoomLocation;
        $room->room_max_ppl = $request->inputRoomMaxPpl;
        $room->save();

        \Session::flash('flash_message', 'New room: '.$room->room_name.' @ '.$room->room_location.' has been added.');
        return redirect('/rooms');
    }

    /**
     * Responds to requests to GET /rooms/edit/{room_id?}
     */
    public function getRoomsEdit($room_id) {
        $room = \App\Room::find($room_id);
        return view('rooms.detail')->with('room', $room)->with('edit', true);
    }

    /**
     * Responds to requests to GET /rooms/view/{room_id?}
     */
    public function getView($room_id) {
        $room = \App\Room::find($room_id);
        return view('rooms.detail')->with('room', $room)->with('edit', false);
    }

    /**
     * Responds to requests to POST /rooms/edit/{room_id?}
     */
    public function postRoomsEdit(Request $request) {
        $this->validate($request,
            [
              'id' => 'required|integer',
              'inputRoomName' => 'required',
              'inputRoomLocation' => 'required',
              'inputRoomMaxPpl' => 'required|integer',
          ]);
        $room = \App\Room::find($request->id);
        $room->room_name = $request->inputRoomName;
        $room->room_location = $request->inputRoomLocation;
        $room->room_max_ppl = $request->inputRoomMaxPpl;
        $room->save();

        \Session::flash('flash_message','Room information has been updated.');
        return redirect('/rooms/view/'.$request->id);
    }

    /**
     * Responds to requests to GET /rooms/confirm-delete/{room_id?}
     */
    public function getConfirmDelete($room_id) {
        $delete_room = \App\Room::find($room_id);
        if(is_null($delete_room)){
            \Session::flash('flash_message','You are trying to delete a room that has already been deleted.');
            return redirect('/rooms');
        }
        else{
            return view('rooms.delete')->with('delete_room', $delete_room);
        }
    }

    /**
     * Responds to requests to POST /rooms/delete/
     */
    public function postDoDelete(Request $request) {
        $this->validate($request,
            [
                'delete_id' => 'required|integer',
            ]
        );

        $user = \Auth::user();
        $delete_room = \App\Room::find($request->delete_id);
        $reservations = \App\Reservation::where('room_id', $delete_room->id)->get();
        $timeslots = \App\Timeslot::where('room_id',$delete_room->id)->get();
        if($user->user_role == 'admin'){
            foreach ($reservations as $reservation) {
                $reservation->delete();
            }
            foreach ($timeslots as $timeslot) {
                $timeslot->delete();
            }
            $delete_room->delete();
            \Session::flash('flash_message', $delete_room->room_name.' has been deleted.');
            return redirect('/rooms');
        }else {
            \Session::flash('flash_message', 'You don&#39;t have the previlege to delete this room.');
            return redirect('/rooms');
        }

    }
}
