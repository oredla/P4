<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller {

    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    /**
     * Responds to requests to GET /user
     */
    public function getUser() {
        return view('users.profile')->with('edit', false);
    }

    /**
     * Responds to requests to GET /user/edit
     */
    public function getUserEdit() {
        return view('users.profile')->with('edit', true);
    }

    /**
     * Responds to requests to POST /user/edit
     */
    public function postUserEdit(Request $request) {
        $this->validate($request,
            [
              'id' => 'required',
              'inputEmail' => 'required|email',
              'inputName' => 'required',
            ]
        );

        $user = \App\User::find($request->id);
        $user->name = $request->inputName;
        $user->email = $request->inputEmail;
        if(($user->user_role == 'admin') and isset($request->inputUserRole)){
            $user->user_role = $request->inputUserRole;
        }
        $user->user_group = $request->inputUserGroup;
        $user->user_verified = $request->inputUserVerified;
        $user->save();

        \Session::flash('flash_message','Your update has been saved.');
        return redirect('/user');
    }

    /**
     * Responds to requests to GET /user/edit/password
     */
    public function getUserPassword() {
        return view('users.password');
    }

    /**
     * Responds to requests to POST /user/edit/password
     */
    public function postUserPassword(Request $request) {
        $this->validate($request,
            [
              'inputCurrentPassword' => 'required|min:8',
              'inputNewPassword' => 'required|min:8',
              'inputConfirmPassword' => 'required|min:8',
            ]
          );

        $user = \App\User::find($request->id);
        if(\Hash::check($request->inputCurrentPassword, $user->password)){
            if ($request->inputNewPassword == $request->inputConfirmPassword){
                $user->password = \Hash::make($request->inputNewPassword);
                $user->save();
                \Session::flash('flash_message','Your password has been changed.');
                return redirect('/user');
            }
            else{
                \Session::flash('flash_message','Your new password and confirm password did not match, please try again.');
                return redirect('/user/edit/password');
            }
        }
        else{
            \Session::flash('flash_message','Your current password is incorrect, please try again.');
            return redirect('/user/edit/password');
        }
    }

    /**
     * Responds to requests to GET /user/confirm-delete
     */
    public function getConfirmDelete($user_id) {
        $delete_user = \App\User::find($user_id);
        if(is_null($delete_user)){
            \Session::flash('flash_message','You are trying to delete an account that has already been deleted.');
            return redirect('/');
        }
        else{
            return view('users.delete')->with('delete_user', $delete_user);
        }
    }

    /**
     * Responds to requests to get /user/delete/{user_id}
     */
    public function postDoDelete(Request $request) {
        $this->validate($request,
            [
                'id' => 'required',
                'delete_id' => 'required',
            ]
        );

        $user = \App\User::find($request->id);
        $delete_user = \App\User::find($request->delete_id);
        if($user->user_role == 'admin'){
            $delete_user->delete();
            \Session::flash('flash_message', $delete_user->name.'&#39;s account has been deleted.');
            // return redirect('/user/manager');
            return redirect('/users');
        }
        elseif($delete_user->id == $user->id){
            \Auth::logout();
            \Session::flash('flash_message', $delete_user->name.'&#39;s account has been deleted. Please contact Administrators for restoring your account.');
            return redirect('/');
        }else {
            \Session::flash('flash_message', 'You don&#39;t have the previlege to delete another user&#39;s account.');
            return redirect('/user');
        }

    }

    /**
     * Responds to requests to GET /user/create
     */
    public function getCreate() {
        return view('users.create');
    }

    /**
     * Responds to requests to POST /user/create
     */
    public function postCreate(Request $request) {
        $this->validate($request,
            [
              'inputEmail' => 'required|email',
              'inputName' => 'required',
              'inputPassword' => 'required|min:8',
              'inputUserRole' => 'required',
              //inputUserGroup and inputUserVerified can leave as optional
            ]
        );
        $user = \App\User::firstOrCreate(['email' => $request->inputEmail]);
        $user->name = $request->inputName;
        $user->email = $request->inputEmail;
        if(!is_null($request->inputUserRole)){
            $user->user_role = $request->inputUserRole;
        }
        if(!is_null($request->inputUserGroup)){
            $user->user_group = $request->inputUserGroup;
        }
        if(!is_null($request->inputUserVerified)){
            $user->user_verified = $request->inputUserVerified;
        }
        $user->save();

        \Session::flash('flash_message','New User: '.$user->name.' has been saved.');
        return redirect('/users');
    }

    /**
     * Responds to requests to GET /users/list
     */
    public function getUsersList() {
        $users = \App\User::all();
        return view('users.list')->with('users',$users);
    }
    /**
     * Responds to requests to GET /users/list
     */
    public function postUsersList($user_id) {

        $users = \App\User::all();
        return view('users.list')->with('users',$users);;
    }
 }
