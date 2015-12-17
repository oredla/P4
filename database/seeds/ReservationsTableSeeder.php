<?php

use Illuminate\Database\Seeder;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $room_id = \App\Room::where('room_name','=','2nd Floor Conference Room')->pluck('id');
        $user_id = \App\User::where('email','=','jill@harvard.edu')->pluck('id');
        $admin_id = \App\User::where('email','=','jack@harvard.edu')->pluck('id');
        DB::table('reservations')->insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'room_id' => $room_id,
            'user_id' => $user_id,
            'user_group' => 'Joshua 1 Fellowship',
            'description_of_event' => $faker->text($maxNbChars = 200),
            'date_of_event' => '12/25/2015',
            'start_time' => '09:00:00',
            'end_time' => '09:30:00',
            'expected_num_of_attendees' => 10,
            'status' => 'approved',
            'status_notes' => 'approved on 12/14/15.',
            'approved_by' => $admin_id,
        ]);

    }
}
