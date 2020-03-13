<?php

use App\Job;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        Job::firstOrCreate(
            [
                'name' => 'Writer',
                'description' => 'Write posts and publish it.'
            ]
         );

        Job::firstOrCreate([
            'name' => 'Reporter',
            'description' => 'Reports reports.'
        ]);
    }

}
