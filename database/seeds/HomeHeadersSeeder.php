<?php

use App\Category;
use App\HomeHeader;
use Illuminate\Database\Seeder;

class HomeHeadersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $texts = ['latest News', 'Most Viewed', 'Categories', 'World News'];

        foreach ($texts as $text) {
            HomeHeader::firstOrCreate(['text' => $text]);
        }
    }
}
