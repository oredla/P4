<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::firstOrCreate(['email' => 'jill@harvard.edu']);
        $user->name = 'Jill';
        $user->email = 'jill@harvard.edu';
        $user->password = \Hash::make('helloworld');
        $user->user_role = 'leader';
        $user->user_group = 'Joshua 1 Fellowship';
        $user->user_verified = false;
        $user->save();

        $user = \App\User::firstOrCreate(['email' => 'jamal@harvard.edu']);
        $user->name = 'Jamal';
        $user->email = 'jamal@harvard.edu';
        $user->password = \Hash::make('helloworld');
        $user->user_role = 'admin';
        $user->user_group = 'Global';
        $user->user_verified = true;
        $user->save();

        $user = \App\User::firstOrCreate(['email' => 'jack@harvard.edu']);
        $user->name = 'Jack';
        $user->email = 'jack@harvard.edu';
        $user->password = \Hash::make('helloworld');
        $user->user_role = 'viewer';
        $user->user_group = 'Joshua 1 Fellowship';
        $user->user_verified = true;
        $user->save();
    }
}
