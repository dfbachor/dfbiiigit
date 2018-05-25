<?php

use Illuminate\Database\Seeder;

class MediumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() 
    {
        \DB::table('mediums')->insert([
            'mediumName' => 'Soil',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \DB::table('mediums')->insert([
            'mediumName' => 'Coco-Coir',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
