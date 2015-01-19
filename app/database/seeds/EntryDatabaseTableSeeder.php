<?php

class EntryDatabaseTableSeeder extends Seeder
{
    public function run()
    {
        DB::table( 'entrydatabases' )->delete();

        EntryDatabase::create( array(
            'type'  => 'Live',
            'name'  => 'World',
            'connect' => true,
            'username' => 'root',
            'password' => 'root',
            'port' => '3306'
        ) );

        EntryDatabase::create( array(
            'type'     => 'Live',
            'name'     => 'SD2',
            'connect'  => true,
            'username' => 'root',
            'password' => 'root',
            'port'     => '3306'
        ) );

        EntryDatabase::create( array(
            'type'     => 'Live',
            'name'     => 'Characters',
            'connect'  => true,
            'username' => 'root',
            'password' => 'root',
            'port'     => '3306'
        ) );

        EntryDatabase::create( array(
            'type'     => 'Live',
            'name'     => 'Realm',
            'connect'  => true,
            'username' => 'root',
            'password' => 'root',
            'port'     => '3306'
        ) );

        EntryDatabase::create( array(
            'type'     => 'Live',
            'name'     => 'Dynamics',
            'connect'  => true,
            'username' => 'root',
            'password' => 'root',
            'port'     => '3306'
        ) );

    }
}