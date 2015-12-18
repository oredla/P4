<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConnectReservationsAndRooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {

            # Add 2 new INT fields, unsigned, for Foreign Fields
            $table->integer('user_id')->unsigned();
            $table->integer('room_id')->unsigned();

            # Connect a foreign key to the `id` field in the 'rooms' and 'users' table
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::table('reservations', function (Blueprint $table) {

            # ref: http://laravel.com/docs/5.1/migrations#dropping-indexes
            # combine tablename + fk field name + the word "foreign"
            $table->dropForeign('reservations_user_id_foreign');
            $table->dropForeign('reservations_room_id_foreign');

            $table->dropColumn('user_id');
            $table->dropColumn('room_id');
        });
    }
}
