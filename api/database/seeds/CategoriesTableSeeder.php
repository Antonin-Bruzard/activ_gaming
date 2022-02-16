<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add Categories
        DB::table('categories')->insert([
            ['id' => 1,'slug' => 'blog', 'title' => 'blog', 'description' => 'Catégorie contenant les news'],
            ['id' => 2,'slug' => 'forum', 'title' => 'forum', 'description' => 'Catégorie contenant le forum'],
        ]);
    }
}
