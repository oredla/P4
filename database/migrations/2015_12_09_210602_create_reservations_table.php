<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// Description: stores a list of reservation requests, pivot between rooms and users.
class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {

            # Increments method will make a Primary, Auto-Incrementing field.
            $table->increments('id');

            # This generates two columns: `created_at` and `updated_at` to
            # keep track of changes to a row
            $table->timestamps();

            # creates a softDeletes field
            $table->softDeletes();

            # The rest of the fields...
            $table->string('user_group');
            $table->text('description_of_event');
            $table->date('date_of_event');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('expected_num_of_attendees');
            $table->string('status', 10);
            $table->text('status_notes');
            $table->integer('approved_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reservations');
    }
}
