<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//dashboard
Route::get('/', function () {
    $user = \Auth::user();
    $reservations = \App\Reservation::orderBy('date_of_event', 'ASC')
                                    ->orderBy('start_time', 'ASC')
                                    ->orderBy('room_id', 'ASC')
                                    ->where('user_id', '=', $user->id)
                                    ->with('room')
                                    ->get();
    return view('welcome')->with('reservations', $reservations);
});

// *****************************************************************************
// User Profile and Management routes
// *****************************************************************************
Route::group(['middleware' => 'auth'], function () {
    Route::get('/user', 'UsersController@getUser');
    Route::get('/user/create', 'UsersController@getCreate');
    Route::get('/user/edit', 'UsersController@getUserEdit');
    Route::get('/user/edit/password', 'UsersController@getUserPassword');
    Route::get('/user/confirm-delete/{user_id?}', 'UsersController@getConfirmDelete');

    Route::post('/user/create', 'UsersController@postCreate');
    Route::post('/user/edit', 'UsersController@postUserEdit');
    Route::post('/user/edit/password', 'UsersController@postUserPassword');
    Route::post('/user/delete', 'UsersController@postDoDelete');

    Route::get('/users', 'UsersController@getUsersList');
    Route::post('/users', 'UsersController@postUsersList');
});


// *****************************************************************************
// Rooms routes
// *****************************************************************************
Route::get('/rooms', 'RoomsController@getRooms');
Route::get('/rooms/roomReservations/{room_id?}', 'RoomsController@getRoomsUpcomingReservations');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/rooms/view/{room_id?}', 'RoomsController@getView');
    Route::get('/rooms/roomReservations/all/{room_id?}', 'RoomsController@getRoomsAllReservations');
    Route::get('/rooms/create', 'RoomsController@getRoomsCreate');
    Route::get('/rooms/edit/{room_id?}', 'RoomsController@getRoomsEdit');
    Route::get('/rooms/confirm-delete/{room_id?}', 'RoomsController@getConfirmDelete');

    Route::post('/rooms/create', 'RoomsController@postRoomsCreate');
    Route::post('/rooms/edit/{room_id?}', 'RoomsController@postRoomsEdit');
    Route::post('/rooms/delete', 'RoomsController@postDoDelete');
});

// *****************************************************************************
// Reservations routes
// *****************************************************************************
Route::get('/reservations', 'ReservationsController@getReservations');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/reservations/view/{reservation_id?}', 'ReservationsController@getMyView');
    Route::get('/reservations/{room_id?}/create', 'ReservationsController@getCreate');
    Route::get('/reservations/edit/{reservation_id?}', 'ReservationsController@getEdit');
    Route::get('/reservations/requests', 'ReservationsController@getRequest');
    Route::get('/reservations/approve/{reservation_id?}', 'ReservationsController@getApprove');
    Route::get('/reservations/reject/{reservation_id?}', 'ReservationsController@getReject');
    Route::get('/reservations/confirm-delete/{timeslot_id?}', 'ReservationsController@getConfirmDelete');

    Route::post('/reservations/{room_id?}/create', 'ReservationsController@postCreate');
    Route::post('/reservations/edit/{reservation_id?}', 'ReservationsController@postEdit');
    Route::post('/reservations/requests', 'ReservationsController@postRequest');
    Route::post('/reservations/delete', 'ReservationsController@postDoDelete');

});

// *****************************************************************************
// Timeslots routes
// *****************************************************************************
Route::group(['middleware' => 'auth'], function () {
    Route::get('/timeslots', 'TimeslotsController@getTimeslots');
    Route::get('/timeslots/view/{timeslot_id?}', 'TimeslotsController@getView');
    Route::get('/timeslots/create', 'TimeslotsController@getCreate');
    Route::get('/timeslots/edit/{timeslot_id?}', 'TimeslotsController@getEdit');
    Route::get('/timeslots/confirm-delete/{timeslot_id?}', 'TimeslotsController@getConfirmDelete');

    Route::post('/timeslots/create', 'TimeslotsController@postCreate');
    Route::post('/timeslots/edit/{timeslot_id?}', 'TimeslotsController@postEdit');
    Route::post('/timeslots/delete', 'TimeslotsController@postDoDelete');
});

 // *****************************************************************************
 // User authentication routes
 // *****************************************************************************
# Show login form
Route::get('/login', 'Auth\AuthController@getLogin');

# Process login form
Route::post('/login', 'Auth\AuthController@postLogin');

# Process logout
Route::get('/logout', 'Auth\AuthController@getLogout');

# Show registration form
Route::get('/register', 'Auth\AuthController@getRegister');

# Process registration form
Route::post('/register', 'Auth\AuthController@postRegister');

 // *****************************************************************************
 // ***********               for DEBUGGING DATABASE                  ***********
 // *****************************************************************************
Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(config('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    /*
    The following line will output your MySQL credentials.
    Uncomment it only if you're having a hard time connecting to the database and you
    need to confirm your credentials.
    When you're done debugging, comment it back out so you don't accidentally leave it
    running on your live server, making your credentials public.
    */
    //print_r(config('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    }
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});


// *****************************************************************************
// ***********               for LOCAL DEVELOPMENT ONLY              ***********
// *****************************************************************************
if(App::environment('local')) {

    // for dropping all tables
    Route::get('/drop', function() {

        DB::statement('DROP database rooms_db');
        DB::statement('CREATE database rooms_db');

        return 'Dropped rooms_db; created rooms_db.';
    });

    Route::get('/confirm-login-worked', function() {

        # You may access the authenticated user via the Auth facade
        $user = Auth::user();

        if($user) {
            echo 'You are logged in.';
            dump($user->toArray());
        } else {
            echo 'You are not logged in.';
        }

        return;

    });
};
