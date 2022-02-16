<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Call seeders from here.
         */
        $this->call([
            RolesAndPermissionsSeeder::class,
            UsersTableSeeder::class,
            SlidersTableSeeder::class,
            ArticlesTableSeeder::class,
            CategoriesTableSeeder::class,
            FilesTableSeeder::class,
            NetworksSeeder::class,
        ]);
    }
}
