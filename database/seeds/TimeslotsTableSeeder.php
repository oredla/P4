<?php

use Illuminate\Database\Seeder;

class TimeslotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $room_id = \App\Room::where('room_name','=','2nd Floor Conference Room')->pluck('id');
        DB::table('timeslots')->insert([
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
        'room_id' => $room_id,
        'available_from' => '09:00:00',
        'available_until' => '18:00:00',
        'available_weekdays' => '0101110',
        ]);

        $room_id = \App\Room::where('room_name','=','2nd Floor Conference Room')->pluck('id');
        DB::table('timeslots')->insert([
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
        'room_id' => $room_id,
        'available_from' => '20:00:00',
        'available_until' => '21:00:00',
        'available_weekdays' => '0100010',
        ]);

        $room_id = \App\Room::where('room_name','=','Room 103')->pluck('id');
        DB::table('timeslots')->insert([
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
        'room_id' => $room_id,
        'available_from' => '09:00:00',
        'available_until' => '12:00:00',
        'available_weekdays' => '0111110',
        ]);

        $room_id = \App\Room::where('room_name','=','Room 101')->pluck('id');
        DB::table('timeslots')->insert([
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
        'room_id' => $room_id,
        'available_from' => '10:00:00',
        'available_until' => '16:00:00',
        'available_weekdays' => '1000011',
        ]);
    }
}
