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
                'url' => 'www.bilgibilim.com/'
            ],
            [
                'text' => 'Manage Reputation',
                'url' => 'www.bilgibilim.com/'
            ],
            [
                'text' => 'Power Tool',
                'url' => 'www.bilgibilim.com/'
            ],
            [
                'text' => 'Marketing Services',
                'url' => 'www.bilgibilim.com/'
            ],
        ];

        foreach ($links as $link) {
            FooterLink::firstOrCreate(['text' => $link['text'], 'url' => $link['url']]);
        }
    }
}
