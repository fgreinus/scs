<?php

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        DB::table( 'permissions' )->delete();

        Permission::create( [
            'name'          => 'entry_view',
            'display_name'  => 'View Entries'
        ] );

        Permission::create( [
            'name'          => 'entry_edit',
            'display_name'  => 'Edit Entries'
        ] );

        Permission::create( [
            'name'          => 'entry_create',
            'display_name'  => 'Create Entries'
        ] );

        Permission::create( [
            'name'          => 'entry_delete',
            'display_name'  => 'Delete Entries'
        ] );

        Permission::create( [
            'name'          => 'entry_manage',
            'display_name'  => 'All entry permissions for entries of all users'
        ] );

        Permission::create( [
            'name'          => 'user_create',
            'display_name'  => 'Create new Users'
        ]);

        Permission::create( [
            'name'          => 'user_edit',
            'display_name'  => 'Edit existing users'
        ]);

        Permission::create( [
            'name'          => 'user_delete',
            'display_name'  => 'Delete users'
        ]);

        Permission::create( [
            'name'          => 'administration',
            'display_name'  => 'Administration'
        ]);

        $administratorRole = Role::firstOrFail();
        $administratorRole->perms()->sync(range(1, 9));

    }
}
