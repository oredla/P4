<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReservationsController extends Controller {

    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    /**
     * Responds to requests to GET /reservations
     */
    public function getReservations() {
        $reservations = \App\Reservation::orderBy('date_of_event', 'ASC')
                                        ->orderBy('start_time', 'ASC')
                                        ->orderBy('room_id', 'ASC')
                                        ->with('room')
                                        ->get();
        return view('reservations.list')->with('reservations', $reservations);
    }

    /**
     * Responds to requests to GET /reservation/{reservation_id?}
     */
    public function getMyView($reservation_id) {
        $user = \Auth::user();
        if($user->user_role == 'admin' || $user->id == $reservation_id){
            $reservations = \App\Reservation::orderBy('date_of_event', 'ASC')
                                            ->orderBy('start_time', 'ASC')
                                            ->orderBy('room_id', 'ASC')
                                            ->where('user_id','=',$reservation_id)
                                            ->with('room')
                                            ->get();

        return view('reservations.mylist')->with('reservations', $reservations);
        }
        else {
            \Session::flash('flash_message','You do not have access to other people&#39;s pending reservations.');
            return redirect('/reservations');
        }

    }

    /**
     * Responds to requests to GET /reservations/edit/{reservation_id?}
     */
    public function getEdit($reservation_id) {
        $rooms_for_dropdown = \App\Room::roomsForDropdown();
        $admins_for_dropdown = \App\User::adminsForDropdown();
        $reservation = \App\Reservation::with('room')
                                        ->with('user')
                                        ->find($reservation_id);

        if ($reservation->date_of_event < date(\Carbon\Carbon::now())){
            \Session::flash('flash_message','Please note you are editing a past event.');
        } elseif ($reservation->date_of_event = date(\Carbon\Carbon::now())){
            \Session::flash('flash_message','Your event is happening today.');
        }

        return view('reservations.detail')->with('reservation', $reservation)
                                        ->with('edit', true)
                                        ->with('rooms_for_dropdown', $rooms_for_dropdown)
                                        ->with('admins_for_dropdown', $admins_for_dropdown);
    }

    /**
     * Responds to requests to POST /reservations/edit/{reservation_id?}
     */
    public function postEdit(Request $request) {
        $this->validate($request,
            [
              'id' => 'required|integer',
              'inputRoomID' => 'required|integer',
              'inputDateOfEvent' => 'required|date',
              'inputStartTime' => 'required',
              'inputEndTime' => 'required',
              'inputNumOfAttendees' => 'required|integer',
              //inputStatus, inputStatusNotes, inputApprovedBy
          ]);
        $reservation = \App\Reservation::find($request->id);
        $reservation->room_id = $request->inputRoomID;
        $reservation->date_of_event = $request->inputDateOfEvent;
        $reservation->start_time = $request->inputStartTime;
        $reservation->end_time = $request->inputEndTime;
        $reservation->description_of_event = $request->inputDescription;
        $reservation->expected_num_of_attendees = $request->inputNumOfAttendees;
        $reservation->status = $request->inputStatus;
        $reservation->status_notes = $request->inputStatusNotes;
        $reservation->save();

        \Session::flash('flash_message','This Reservation has been updated.');
        return redirect('/reservations/view/'.$reservation->id);
    }

    /**
     * Responds to requests to GET /reservation/create
     */
    public function getCreate($room_id) {
        $rooms_for_dropdown = \App\Room::roomsForDropdown();
        $room = \App\Room::find($room_id);
        return view('reservations.create')->with('rooms_for_dropdown', $rooms_for_dropdown)
                                            ->with('room', $room);
    }

    /**
     * Responds to requests to POST /reservation/create
     */
    public function postCreate(Request $request) {
        $this->validate($request,
            [
              'id' => 'required|integer',
              'inputRoomID' => 'required|integer',
              'inputDateOfEvent' => 'required|date',
              'inputStartTime' => 'required',
              'inputEndTime' => 'required',
              'inputNumOfAttendees' => 'required|integer',
              'inputDescriptions' => 'required',
            ]);

        $reservation = new \App\Reservation();
        $reservation->user_id = $request->id;
        $reservation->room_id = $request->inputRoomID;
        $reservation->user_group = $request->inputUserGroup;
        $reservation->description_of_event = $request->inputDescriptions;
        $reservation->date_of_event = $request->inputDateOfEvent;
        $reservation->start_time = $request->inputStartTime;
        $reservation->end_time = $request->inputEndTime;
        $reservation->expected_num_of_attendees = $request->inputNumOfAttendees;
        $reservation->status = 'pending';
        $reservation->approved_by = 0;
        // $reservation->approved_by =;

        $reservation->save();

        \Session::flash('flash_message', 'New reservation has been recorded.');
        return redirect('/reservations');
    }
    /**
     * Responds to requests to GET /reservations/confirm-delete/{reservation_id?}
     */
    public function getConfirmDelete($reservation_id) {
        $delete_res = \App\Reservation::find($reservation_id);
        if(is_null($delete_res)){
            \Session::flash('flash_message','You are trying to delete a reservation that has already been deleted.');
            return redirect('/reservations');
        }
        else{
            return view('reservations.delete')->with('delete_res', $delete_res);
        }
    }

    public function getApprove($reservation_id) {
        $reservation = \App\Reservation::find($reservation_id);
        $user = \Auth::user();
        if(is_null($reservation)){
            \Session::flash('flash_message','You are trying to approve a reservation that has already been deleted.');
            return redirect('/reservations');
        }
        else{
            if($user->user_role == 'admin'){
                if($reservation->status != 'approved'){
                    $reservation->approved_by = $user->id;
                    $reservation->status = 'approved';
                    $reservation->status_notes = 'This has been approved by '.$user->name.' on '.date(\Carbon\Carbon::now()).'.';

                    $reservation->save();

                    \Session::flash('flash_message','The approval for the reservation had been updated.');
                    return redirect('/reservations');
                }else{
                    \Session::flash('flash_message','The reservation had already been approved previously.');
                    return redirect('/reservations');
                }
            }
        }
    }

    /**
     * Responds to requests to POST /reservations/delete/
     */
    public function postDoDelete(Request $request) {
        $this->validate($request,
            [
                'id' => 'required|integer',
                'delete_id' => 'required|integer',
            ]
        );

        $user = \Auth::user();
        $delete_res = \App\Reservation::find($request->delete_id);
        if($user->user_role == 'admin' || $request->id == $user->id){
            $delete_res->delete();
            \Session::flash('flash_message', 'Reservation has been deleted.');
            return redirect('/reservations');
        }else {
            \Session::flash('flash_message', 'You don&#39;t have the previlege to delete this reservation.');
            return redirect('/reservations');
        }

    }
}
