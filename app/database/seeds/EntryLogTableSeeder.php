<?php
/**
 * Created by PhpStorm.
 * User: Dude
 * Date: 26.07.14
 * Time: 17:44
 */

class EntryLogTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('entrylogs')->delete();

        EntryLog::create(array(
            'user_id'       => User::firstOrFail()->id, // admin
            'entry_id'      => 1,
            'action_id'     => 1,
            'note'          => 'abcd',
            'queries'        => 'dsa',
            'revert_queries' => 'asd',
            'database_id' => 1,
            'category_id' => 1
        ));

        EntryLog::create(array(
            'user_id'       => User::firstOrFail()->id,
            'entry_id'      => 1,
            'action_id'     => 1,
            'note'          => 'efg',
            'queries'        => 'dsa',
            'revert_queries' => 'asd',
            'database_id'    => 1,
            'category_id'    => 1
        ));

    }
}