<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TimeslotsController extends Controller {

    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    /**
     * Responds to requests to GET /timeslots
     */
    public function getTimeslots() {
        $timeslots = \App\Timeslot::orderBy('room_id', 'ASC')
                            ->orderBy('available_from', 'ASC')
                            ->with('room')
                            ->get();
        return view('timeslots.list')->with('timeslots', $timeslots);
    }

    /**
     * Responds to requests to GET /timeslots/view/{timeslot_id?}
     */
    public function getView($timeslot_id) {
        $timeslot = \App\Timeslot::find($timeslot_id);
        return view('timeslots.detail')->with('timeslot', $timeslot)
                                        ->with('edit', false);
    }

    /**
     * Responds to requests to GET /timeslots/create
     */
    public function getCreate() {
        $rooms_for_dropdown = \App\Room::roomsForDropdown();
        return view('timeslots.create')->with('rooms_for_dropdown', $rooms_for_dropdown);
    }

    /**
     * Responds to requests to POST /timeslots/create
     */
    public function postCreate(Request $request) {
        $this->validate($request,
            [
              'inputRoomID' => 'required',
              'inputAvailableFrom' => 'required',
              'inputAvailableUntil' => 'required',
            ]);

        $timeslot = new \App\Timeslot();
        $timeslot->room_id = $request->inputRoomID;
        $timeslot->available_from = $request->inputAvailableFrom;
        $timeslot->available_until = $request->inputAvailableUntil;
        $timeslot->available_weekdays = $request->inputSun
                                        +$request->inputMon +$request->inputTue
                                        +$request->inputWed +$request->inputThu
                                        +$request->inputFri +$request->inputSat;
        $timeslot->save();

        \Session::flash('flash_message', 'New timeslot has been added.');
        return redirect('/timeslots');
    }

    /**
     * Responds to requests to GET /timeslots/edit/{timeslot_id?}
     */
    public function getEdit($timeslot_id) {
        $rooms_for_dropdown = \App\Room::roomsForDropdown();
        $timeslot = \App\Timeslot::find($timeslot_id);
        return view('timeslots.detail')->with('timeslot', $timeslot)
                                        ->with('edit', true)
                                        ->with('rooms_for_dropdown', $rooms_for_dropdown);
    }

    /**
     * Responds to requests to POST /timeslots/edit/{timeslot_id?}
     */
    public function postEdit(Request $request) {
        $this->validate($request,
            [
              'id' => 'required|integer',
              'inputRoomID' => 'required|integer',
              'inputAvailableFrom' => 'required',
              'inputAvailableUntil' => 'required',
          ]);
        $timeslot = \App\Timeslot::find($request->id);
        $timeslot->room_id = $request->inputRoomID;
        $timeslot->available_from = $request->inputAvailableFrom;
        $timeslot->available_until = $request->inputAvailableUntil;
        $timeslot->available_weekdays = $request->inputSun
                                        +$request->inputMon +$request->inputTue
                                        +$request->inputWed +$request->inputThu
                                        +$request->inputFri +$request->inputSat;
        $timeslot->save();

        \Session::flash('flash_message','Timeslot information has been updated.');
        return redirect('/timeslots/view/'.$request->id);
    }

    /**
     * Responds to requests to GET /timeslots/confirm-delete/{timeslot_id?}
     */
    public function getConfirmDelete($timeslot_id) {
        $delete_timeslot = \App\Timeslot::find($timeslot_id);
        if(is_null($delete_timeslot)){
            \Session::flash('flash_message','You are trying to delete a timeslot that has already been deleted.');
            return redirect('/timeslots');
        }
        else{
            return view('timeslots.delete')->with('delete_timeslot', $delete_timeslot);
        }
    }

    /**
     * Responds to requests to POST /timeslots/delete/
     */
    public function postDoDelete(Request $request) {
        $this->validate($request,
            [
                'delete_id' => 'required|integer',
            ]
        );

        $user = \Auth::user();
        $delete_timeslot = \App\Timeslot::find($request->delete_id);
        if($user->user_role == 'admin'){
            $delete_timeslot->delete();
            \Session::flash('flash_message', 'Timeslot has been deleted.');
            return redirect('/timeslots');
        }else {
            \Session::flash('flash_message', 'You don&#39;t have the previlege to delete this room.');
            return redirect('/timeslots');
        }

    }
}
