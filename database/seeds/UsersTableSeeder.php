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
        // \DB::table('users')->truncate();
        \DB::table('users')->insert([
            'name' => 'Dave B', 
            'systemID' => 1,
            'username' => 'daveb',
            'email' => 'dave@dfbiii.com',
            'password' => '$2y$10$ZA17u.DWt6eZuPNdJ2eAS.YEQ/3nEUBR.3KYVK2vJLDlcZy18Q9hC',
            'role' => 'a',
        ]);

        \DB::table('users')->insert([
            'name' => 'Demo',
            'username' => 'Demo', 
            'systemID' => 2,
            'email' => 'demo@garden.com',
            'password' => bcrypt('demodemo'),
            'role' => 'a',
        ]);

        \DB::table('users')->insert([
            'name' => 'Max Wellhouse', 
            'systemID' => 2,
            'username' => 'maxwellhouse',
            'email' => 'maxe@wellhouse.com',
            'password' => bcrypt('maxmax'),
            'role' => 'u',
        ]);

    }
}
