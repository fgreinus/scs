<?php

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        DB::table( 'roles' )->delete();

        $adminRole = Role::create( [
            'name'   => 'admin',
        ] );

        Role::create( [
            'name'   => 'developer',
        ] );

        Role::create( [
            'name' => 'tester',
        ] );

        Role::create( [
            'name' => 'guest',
        ] );

        User::firstOrFail()->attachRole($adminRole);
    }
}