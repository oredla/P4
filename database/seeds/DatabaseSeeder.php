<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

         $this->call(RoomsTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(TimeslotsTableSeeder::class);
         $this->call(ReservationsTableSeeder::class);

        Model::reguard();
    }
}
