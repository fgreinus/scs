<?php

class EntryCategoryTableSeeder extends Seeder
{
    public function run()
    {
        DB::table( 'entrycategories' )->delete();

        EntryCategory::create( array(
            'name'      => 'NPC',
            'code'      => 'npc'
        ) );

        EntryCategory::create( array(
            'name' => 'Quest',
            'code' => 'quest'
        ) );

        EntryCategory::create( array(
            'name' => 'Spell',
            'code' => 'spell'
        ) );

        EntryCategory::create( array(
            'name' => 'Instance',
            'code' => 'instance'
        ) );

        EntryCategory::create( array(
            'name' => 'Custom',
            'code' => 'custom'
        ) );

        EntryCategory::create( array(
            'name' => 'Backport',
            'code' => 'backport'
        ) );

        EntryCategory::create( array(
            'name' => 'PvP',
            'code' => 'pvp'
        ) );

        EntryCategory::create( array(
            'name' => 'Other',
            'code' => 'undefined'
        ) );

    }
}