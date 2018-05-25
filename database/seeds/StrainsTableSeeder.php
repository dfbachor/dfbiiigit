<?php

use Illuminate\Database\Seeder;

class StrainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('strains')->insert([
            'systemID' => 2,
            'strainName' => 'Roses',
            'testingStatus' => 'NA',
            'genetics' => 'they are red and bring smiles to womans faces',
            'floweringTimeInDays' => 40,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \DB::table('strains')->insert([
            'systemID' => 2,
            'strainName' => 'Cottonweed',
            'testingStatus' => 'NA',
            'genetics' => 'It\'s Cotton weed',
            'floweringTimeInDays' => 40,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \DB::table('strains')->insert([
            'systemID' => 2,
            'strainName' => 'Cattail',
            'testingStatus' => 'NA',
            'genetics' => 'It\'s cattail',
            'floweringTimeInDays' => 40,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \DB::table('strains')->insert([
            'systemID' => 2,
            'strainName' => 'Rudebekia',
            'testingStatus' => 'NA',
            'genetics' => 'It\'s Rudebekia',
            'floweringTimeInDays' => 40,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \DB::table('strains')->insert([
            'systemID' => 2,
            'strainName' => 'Salvia',
            'testingStatus' => 'NA',
            'genetics' => 'It\'s cattail',
            'floweringTimeInDays' => 40,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \DB::table('strains')->insert([
            'systemID' => 2,
            'strainName' => 'Sage',
            'testingStatus' => 'NA',
            'genetics' => 'It\'s sage',
            'floweringTimeInDays' => 40,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
