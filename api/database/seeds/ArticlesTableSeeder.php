<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add Articles
        DB::table('articles')->insert([
            ['title' => 'Article 1', 'img_large_id' => 16, 'img_id' => 17, 'category_id' => 1, 'user_id' => 1, 'description' => 'Article en ligne', 'created_at' => '2019-09-01 01:29:57', 'content' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cupiditate dolor similique deserunt sit modi pariatur! Sint hic, veniam distinctio nemo tempore velit officia consectetur ut itaque qui labore? Mollitia quibusdam beatae optio molestias est, ducimus accusantium quam recusandae.', 'slug' => 'article-1', 'published' => '2019-09-01 01:32:57'],
            ['title' => 'Article 2', 'img_large_id' => 13, 'img_id' => 18, 'category_id' => 1, 'user_id' => 2, 'description' => 'Article hors ligne', 'created_at' => '2019-09-01 01:30:57', 'content' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cupiditate dolor similique deserunt sit modi pariatur! Sint hic, veniam distinctio nemo tempore velit officia consectetur ut itaque qui labore? Mollitia quibusdam beatae optio molestias est, ducimus accusantium quam recusandae.', 'slug' => 'article-2', 'published' => null],
            ['title' => 'Article 3', 'img_large_id' => 10, 'img_id' => 19, 'category_id' => 1, 'user_id' => 3, 'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit.', 'created_at' => '2019-09-01 01:31:57', 'content' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cupiditate dolor similique deserunt sit modi pariatur! Sint hic, veniam distinctio nemo tempore velit officia consectetur ut itaque qui labore? Mollitia quibusdam beatae optio molestias est, ducimus accusantium quam recusandae.', 'slug' => 'article-3', 'published' => '2019-09-01 01:32:57'],
            ['title' => 'Article 4', 'img_large_id' => 14, 'img_id' => 20, 'category_id' => 1, 'user_id' => 4, 'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit.', 'created_at' => '2019-09-01 01:32:57', 'content' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cupiditate dolor similique deserunt sit modi pariatur! Sint hic, veniam distinctio nemo tempore velit officia consectetur ut itaque qui labore? Mollitia quibusdam beatae optio molestias est, ducimus accusantium quam recusandae.', 'slug' => 'article-4', 'published' => '2019-09-01 01:32:57'],
            ['title' => 'Article 5', 'img_large_id' => 14, 'img_id' => 20, 'category_id' => 1, 'user_id' => 4, 'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit.', 'created_at' => '2019-09-01 01:32:57', 'content' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cupiditate dolor similique deserunt sit modi pariatur! Sint hic, veniam distinctio nemo tempore velit officia consectetur ut itaque qui labore? Mollitia quibusdam beatae optio molestias est, ducimus accusantium quam recusandae.', 'slug' => 'article-5', 'published' => '2019-09-01 01:32:57']
        ]);
    }
}
