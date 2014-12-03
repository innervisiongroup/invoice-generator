<?php 

class UsersTableSeeder extends Seeder {

    public function run()
    {
        User::truncate();

        User::create(array(
            'username' => 'admin',
            'password' => Hash::make('admin'),
        ));
    }
}