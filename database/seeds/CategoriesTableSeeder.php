<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1 = ['title' => 'Laravel'];
        $category2 = ['title' => 'JQuery'];
        $category3 = ['title' => 'IOS'];
        $category4 = ['title' => 'Android'];

        Category::create($category1);
        Category::create($category2);
        Category::create($category3);
        Category::create($category4);
    }
}
