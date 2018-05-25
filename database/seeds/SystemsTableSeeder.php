<?php

use Illuminate\Database\Seeder;

class SystemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() 
    {
        \DB::table('systems')->insert([
            'id' => '1',
            'companyName' => 'dfbiii', 
            'companyPhone' => '610-761-7450',
            'email' => 'dave@dfbiii.com',
            'showCompleteGrows' => 1,
            'showClosedTasks' => 1,
            'maxPlantCount' => 25,
            'maxBatchCount' => 25,
            'maxBatchSize' => 25,
            'imageFileName' => '/img/default.png',
            'hits' => 0,
            'operatorUserName' => 'dfb',
            'creationDate' => now(),
        ]);

        \DB::table('systems')->insert([
            'id' => '2',
            'companyName' => 'Demo Garden', 
            'companyPhone' => '610-761-7450',
            'email' => 'demo@garden.com',
            'showCompleteGrows' => 1,
            'showClosedTasks' => 1,
            'maxPlantCount' => 25,
            'maxBatchCount' => 25,
            'maxBatchSize' => 25,
            'imageFileName' => '/img/default.png',
            'hits' => 0,
            'operatorUserName' => 'dfb',
            'creationDate' => now(),
        ]);
    }
}
