<?php 

class UsersTableSeeder extends Seeder {

    public function run()
    {
        User::truncate();

        User::create(array(
            'email'    => 'admin',
            'password' => Hash::make('admin'),
        ));
    }
}