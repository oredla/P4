<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConnectRoomsAndTimeslots extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('timeslots', function (Blueprint $table) {

            # Add a new INT field called `room_id` that has to be unsigned (i.e. positive) to the time_slots table
            $table->integer('room_id')->unsigned();

            # This field `room_id` is a foreign key that connects to the `id` field in the `authors` table
            $table->foreign('room_id')->references('id')->on('rooms');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('timeslots', function (Blueprint $table) {

            # ref: http://laravel.com/docs/5.1/migrations#dropping-indexes
            # combine tablename + fk field name + the word "foreign"
            $table->dropForeign('timeslots_room_id_foreign');

            $table->dropColumn('room_id');
        });
    }
}
