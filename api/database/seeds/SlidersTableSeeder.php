<?php

use Illuminate\Database\Seeder;

class SlidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add Sliders
        DB::table('sliders')->insert([
            ['title' => 'Lorem Ipsum 1', 'image_id' => 11, 'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cupiditate dolor similique deserunt sit modi pariatur! Sint hic, veniam distinctio nemo tempore velit officia consectetur ut itaque qui labore? Mollitia quibusdam beatae optio molestias est, ducimus accusantium quam recusandae.'],
            ['title' => 'Lorem Ipsum 2', 'image_id' => 12, 'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cupiditate dolor similique deserunt sit modi pariatur! Sint hic, veniam distinctio nemo tempore velit officia consectetur ut itaque qui labore? Mollitia quibusdam beatae optio molestias est, ducimus accusantium quam recusandae.'],
            ['title' => 'Lorem Ipsum 3', 'image_id' => 13, 'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cupiditate dolor similique deserunt sit modi pariatur! Sint hic, veniam distinctio nemo tempore velit officia consectetur ut itaque qui labore? Mollitia quibusdam beatae optio molestias est, ducimus accusantium quam recusandae.'],
            ['title' => 'Lorem Ipsum 4', 'image_id' => 14, 'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cupiditate dolor similique deserunt sit modi pariatur! Sint hic, veniam distinctio nemo tempore velit officia consectetur ut itaque qui labore? Mollitia quibusdam beatae optio molestias est, ducimus accusantium quam recusandae.'],
        ]);
    }
}
