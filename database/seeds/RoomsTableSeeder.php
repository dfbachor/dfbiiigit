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
        \DB::table('rooms')->insert([
            'systemID' => 2,
            'roomName' => 'Dining Room',
            'lighting' => 'sunlight', 
            'humidifier' => 'as needed', 
            'comment' => '12x12 dining roomwith 2 windows', 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \DB::table('rooms')->insert([
            'systemID' => 2,
            'roomName' => 'Porch',
            'lighting' => 'sunlight', 
            'humidifier' => 'as needed', 
            'comment' => 'Outdoor porch with dappled sunlilght', 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \DB::table('rooms')->insert([
            'systemID' => 2,
            'roomName' => 'Outside',
            'lighting' => 'sunlight', 
            'humidifier' => 'as needed', 
            'comment' => 'outside with mostly sun', 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
