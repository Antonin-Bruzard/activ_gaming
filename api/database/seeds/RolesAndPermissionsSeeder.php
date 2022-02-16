<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        /*
        |--------------------------------------------------------------------------
        | Permissions
        |--------------------------------------------------------------------------
        |
        | Permissions give rights on one action.
        | You can give a customize name for it.
        | Permissions can assigns to a specify role or directly to one user.
        | In case user have a role who have permissions. User will earn role's permissions.
        |
        */

        /* General */
        Permission::create(['name' => 'login']);
        Permission::create(['name' => 'user-edit-own']);
        Permission::create(['name' => 'user-edit-any']);

        /* News */
        Permission::create(['name' => 'news-create']);
        Permission::create(['name' => 'news-edit']);
        Permission::create(['name' => 'news-publish']);
        Permission::create(['name' => 'news-delete']);
        Permission::create(['name' => 'news-unpublish']);

        /* Forum */
        Permission::create(['name' => 'forum-create']);
        Permission::create(['name' => 'forum-edit-own']);
        Permission::create(['name' => 'forum-edit-any']);
        Permission::create(['name' => 'forum-delete-own']);
        Permission::create(['name' => 'forum-delete-any']);
        Permission::create(['name' => 'forum-disable-any']);

        /* Network */
        Permission::create(['name' => 'network-create']);
        Permission::create(['name' => 'network-update']);
        Permission::create(['name' => 'network-delete']);

        /* Category */
        Permission::create(['name' => 'category-create']);
        Permission::create(['name' => 'category-edit']);
        Permission::create(['name' => 'category-delete']);


        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        |
        | Roles can assign to multiple users.
        | If a role have permissions, user will have them.
        |
        */

        /* Create pivot roles */
        $inactive = Role::create(['name' => 'inactive']);

        /* Create classic roles */
        $user = Role::create(['name' => 'user']);

        /* Create staff roles */
        $writer = Role::create(['name' => 'writer']);
        $moderator = Role::create(['name' => 'moderator']);
        $administrator = Role::create(['name' => 'administrator']);
        $superAdmin = Role::create(['name' => 'super-admin']);

        /* Create user who has been banned from staff roles */
        $banned = Role::create(['name' => 'banned']);

        /*
        |--------------------------------------------------------------------------
        | Assignment : Give permissions to roles.
        |--------------------------------------------------------------------------
        */

        /*
         | General
         */

        /* login */
        $user->givePermissionTo('login');
        $writer->givePermissionTo('login');
        $moderator->givePermissionTo('login');
        $administrator->givePermissionTo('login');

        /* user edit */
        $user->givePermissionTo('user-edit-own');
        $writer->givePermissionTo('user-edit-own');
        $moderator->givePermissionTo('user-edit-own');
        $administrator->givePermissionTo('user-edit-own');
        $administrator->givePermissionTo('user-edit-any');

        /*
         | News
         */

        /* writer */
        $writer->givePermissionTo('news-create');
        $writer->givePermissionTo('news-edit');
        $writer->givePermissionTo('news-publish');

        /* moderator */
        $moderator->givePermissionTo('news-create');
        $moderator->givePermissionTo('news-edit');
        $moderator->givePermissionTo('news-publish');
        $moderator->givePermissionTo('news-unpublish');
        $moderator->givePermissionTo('news-delete');

        /* administrator */
        $administrator->givePermissionTo('news-create');
        $administrator->givePermissionTo('news-edit');
        $administrator->givePermissionTo('news-publish');
        $administrator->givePermissionTo('news-unpublish');
        $administrator->givePermissionTo('news-delete');

        /*
         | Forum
         */

        /* user */
        $user->givePermissionTo('forum-create');
        $user->givePermissionTo('forum-edit-own');
        $user->givePermissionTo('forum-delete-own');

        /* writer */
        $writer->givePermissionTo('forum-create');
        $writer->givePermissionTo('forum-edit-own');
        $writer->givePermissionTo('forum-delete-own');

        /* moderator */
        $moderator->givePermissionTo('forum-create');
        $moderator->givePermissionTo('forum-edit-own');
        $moderator->givePermissionTo('forum-delete-own');
        $moderator->givePermissionTo('forum-disable-any');

        /* administrator */
        $administrator->givePermissionTo('forum-create');
        $administrator->givePermissionTo('forum-edit-any');
        $administrator->givePermissionTo('forum-delete-any');
        $administrator->givePermissionTo('forum-disable-any');

        /*
         | Networks
         */

        $administrator->givePermissionTo('network-create');
        $administrator->givePermissionTo('network-update');
        $administrator->givePermissionTo('network-delete');

        /*
         | Category
         */

        /* administrator */
        $administrator->givePermissionTo('category-create');
        $administrator->givePermissionTo('category-edit');
        $administrator->givePermissionTo('category-delete');

        /*
        |--------------------------------------------------------------------------
        | Assignment : Give full rights to super administrator.
        |--------------------------------------------------------------------------
        */
        $superAdmin->givePermissionTo(Permission::all());
    }
}
