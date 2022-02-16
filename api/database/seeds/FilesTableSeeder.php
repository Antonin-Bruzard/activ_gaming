<?php

use Illuminate\Database\Seeder;

class FilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add Files
        DB::table('files')->insert([
            ['name' => 'article_sample', 'path' => '/article-sample.jpg'],
            ['name' => 'avatar_01', 'path' => '/user-avatar-1.png'],
            ['name' => 'avatar_02', 'path' => '/user-avatar-2.png'],
            ['name' => 'avatar_03', 'path' => '/user-avatar-3.png'],
            ['name' => 'avatar_04', 'path' => '/user-avatar-4.png'],
            ['name' => 'avatar_05', 'path' => '/user-avatar-5.png'],
            ['name' => 'avatar_06', 'path' => '/user-avatar-6.png'],
            ['name' => 'avatar_07', 'path' => '/user-avatar-7.png'],
            ['name' => 'slider_01', 'path' => '/slider-1.jpg'],
            ['name' => 'slider_02', 'path' => '/slider-2.jfif'],
            ['name' => 'slider_03', 'path' => '/slider-3.jpg'],
            ['name' => 'slider_04', 'path' => '/slider-4.png'],
            ['name' => 'slider_05', 'path' => '/slider-5.png'],
            ['name' => 'slider_06', 'path' => '/slider-6.jpg'],
            ['name' => 'slider_07', 'path' => '/slider-7.png'],
            ['name' => 'slider_08', 'path' => '/slider-8.png'],
            ['name' => 'article_01', 'path' => '/article-1.png'],
            ['name' => 'article_little_01', 'path' => '/article-little-1.png'],
            ['name' => 'article_little_02', 'path' => '/article-little-2.png'],
            ['name' => 'article_little_03', 'path' => '/article-little-3.png'],
            ['name' => 'article_little_04', 'path' => '/article-little-4.png'],
        ]);
    }
}
