<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $categories = ['Science', 'Economy', 'Media', 'Sports', 'Technology', 'Politics', 'World'];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category, 'description' => $category]);
        }
    }
}
