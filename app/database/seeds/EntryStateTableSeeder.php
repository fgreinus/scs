<?php

class EntryStateTableSeeder extends Seeder
{
    public function run()
    {
        DB::table( 'entrystates' )->delete();

        EntryState::create( array(
            'name'  => 'New',
            'code'  => 'new',
            'color' => 'info',
            'action_id' => '2'
        ) );

        EntryState::create( array(
            'name'  => 'Test',
            'code'  => 'test',
            'color' => 'warning',
            'action_id' => '1'
        ) );

        EntryState::create( array(
            'name'  => 'Pending',
            'code'  => 'pending',
            'color' => 'primary',
            'action_id' => '6'
        ) );

        EntryState::create( array(
            'name'  => 'Rejected',
            'code'  => 'reject',
            'color' => 'danger',
            'action_id' => '4'
        ) );

        EntryState::create( array(
            'name'  => 'Reverted',
            'code'  => 'revert',
            'color' => 'default',
            'action_id' => '4'
        ) );

        EntryState::create( array(
            'name'  => 'Live',
            'code'  => 'live',
            'color' => 'success',
            'action_id' => '7'
        ) );


    }
}