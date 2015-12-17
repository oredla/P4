<?php

use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'room_name' => 'Room 101',
            'room_location' => 'JQUS Building',
            'room_max_ppl' => 100,
        ]);
        
        DB::table('rooms')->insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'room_name' => 'Room 103',
            'room_location' => 'JQUS Building',
            'room_max_ppl' => 30,
        ]);

        DB::table('rooms')->insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'room_name' => '2nd Floor Conference Room',
            'room_location' => '237 Office Building',
            'room_max_ppl' => 20,
        ]);

        DB::table('rooms')->insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'room_name' => 'Basement Multi-Function Room',
            'room_location' => '249 Main Building',
            'room_max_ppl' => 100,
        ]);

        DB::table('rooms')->insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'room_name' => '2nd Floor Piano Room',
            'room_location' => '249 Main Building',
            'room_max_ppl' => 20,
        ]);
    }
}
