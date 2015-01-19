<?php
/**
 * Created by PhpStorm.
 * User: Dude
 * Date: 26.07.14
 * Time: 17:43
 */

class EntryTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('entries')->delete();

        Entry::create([
            'user_id'           => 1,
            'title'             => 'Test Eintrag 1',
            'database_id'       => 1,
            'category_id'       => 1,
            'queries'           => 'SELECT 1;',
            'revert_queries'    => 'SELECT 2;',
            'state_id'          => 1,
            'ticket_id'         => 9001
        ]);

        for ($i = 2; $i < 25; $i++)
        {
            Entry::create([
                'user_id'           => 1,
                'title'             => 'Test Eintrag '.$i,
                'database_id'       => 1,
                'category_id'       => 1,
                'queries'           => 'SELECT 1;',
                'revert_queries'    => 'SELECT 2;',
                'state_id'          => 1,
                'ticket_id'         => 9001
            ]);
        }
    }
}
