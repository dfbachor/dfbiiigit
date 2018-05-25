<?php

use Illuminate\Database\Seeder;

class StagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() 
    {
        \DB::table('stages')->insert([
            'stageName' => 'Seedling',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \DB::table('stages')->insert([
            'stageName' => 'Vegetagive',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \DB::table('stages')->insert([
            'stageName' => 'Flowering',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \DB::table('stages')->insert([
            'stageName' => 'Drying',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \DB::table('stages')->insert([
            'stageName' => 'Curing',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \DB::table('stages')->insert([
            'stageName' => 'Germination',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \DB::table('stages')->insert([
            'stageName' => 'Storing',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
