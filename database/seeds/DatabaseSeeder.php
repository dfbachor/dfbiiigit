<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        $this->call(UsersTableSeeder::class);
        $this->call(SystemsTableSeeder::class);
        $this->call(MediumsTableSeeder::class);
        $this->call(StagesTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(StrainsTableSeeder::class);
    }
}
