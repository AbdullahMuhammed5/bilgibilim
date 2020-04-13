<?php

use App\Category;
use App\FooterLink;
use Illuminate\Database\Seeder;

class FooterLinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $links = [
            [
                'text' => 'Manage website',
                'url' => 'bilgibilim.com/'
            ],
            [
                'text' => 'Manage Reputation',
                'url' => 'bilgibilim.com/'
            ],
            [
                'text' => 'Power Tool',
                'url' => 'bilgibilim.com/'
            ],
            [
                'text' => 'Marketing Services',
                'url' => 'bilgibilim.com/'
            ],
        ];

        foreach ($links as $link) {
            FooterLink::firstOrCreate(['text' => $link['text'], 'url' => $link['url']]);
        }
    }
}
