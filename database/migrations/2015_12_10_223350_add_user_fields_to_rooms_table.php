<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserFieldsToRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            # creates a softDeletes field
            $table->softDeletes();

            $table->string('user_role');
            $table->string('user_group');
            $table->boolean('user_verified');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_verified');
            $table->dropColumn('user_group');
            $table->dropColumn('user_role');
            $table->dropSoftDeletes();
        });
    }
}
