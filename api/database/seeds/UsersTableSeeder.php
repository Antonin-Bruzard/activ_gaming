<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add users
        DB::table('users')->insert([
            ['name' => 'Dekadmin', 'email' => 'guillian77270@gmail.com', 'avatar_id' => 2, 'password' => bcrypt('dev')],
            ['name' => 'Darcks', 'email' => 'darcks28@gmail.com', 'avatar_id' => 7, 'password' => bcrypt('dev')],
            ['name' => 'Weedy', 'email' => 'costa-roch.quentin@gmail.com', 'avatar_id' => 1, 'password' => bcrypt('dev')],
            ['name' => 'Dev', 'email' => 'dev@dev.com', 'avatar_id' => 4, 'password' => bcrypt('dev')],

            ['name' => 'Banned', 'email' => 'banned@banned.com', 'avatar_id' => 4, 'password' => bcrypt('dev')],
            ['name' => 'Inactive', 'email' => 'inactive@inactive.com', 'avatar_id' => 4, 'password' => bcrypt('dev')],
            ['name' => 'User', 'email' => 'user@user.com', 'avatar_id' => 4, 'password' => bcrypt('dev')],

            ['name' => 'Writer', 'email' => 'writer@writer.com', 'avatar_id' => 4, 'password' => bcrypt('dev')],
            ['name' => 'Moderator', 'email' => 'moderator@moderator.com', 'avatar_id' => 4, 'password' => bcrypt('dev')],
            ['name' => 'Administrator', 'email' => 'administrator@administrator.com', 'avatar_id' => 4, 'password' => bcrypt('dev')],
        ]);

        /**
         * ASSIGN ROLES TO USERS
         * Open "RolesAndPermissionsSeeder" to know more about roles.
         */
        $role = Role::findByName('administrator');

        $user = App\Models\User::find(1);
        $user->assignRole($role);

        $user = App\Models\User::find(2);
        $user->assignRole($role);

        $user = App\Models\User::find(3);
        $user->assignRole($role);

        $user = App\Models\User::find(4);
        $user->assignRole($role);

        $role = Role::findByName('banned');
        $user = App\Models\User::find(5);
        $user->assignRole($role);

        $role = Role::findByName('inactive');
        $user = App\Models\User::find(6);
        $user->assignRole($role);

        $role = Role::findByName('user');
        $user = App\Models\User::find(7);
        $user->assignRole($role);

        $role = Role::findByName('writer');
        $user = App\Models\User::find(8);
        $user->assignRole($role);

        $role = Role::findByName('moderator');
        $user = App\Models\User::find(9);
        $user->assignRole($role);

        $role = Role::findByName('administrator');
        $user = App\Models\User::find(10);
        $user->assignRole($role);
    }
}
