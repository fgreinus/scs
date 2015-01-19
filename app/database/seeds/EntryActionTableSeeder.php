<?php

class EntryActionTableSeeder extends Seeder
{

    public function run()
    {
        DB::table( 'entryactions' )->delete();

        EntryAction::create( [
            'name'  => 'Test',
            'code'  => 'test',
            'color' => 'warning',
            'icon'  => 'ok'
        ]);
        EntryAction::create( [
            'name'  => 'Created',
            'code'  => 'create',
            'color' => 'info',
            'icon'  => 'plus'
        ] );
        EntryAction::create( [
            'name'  => 'Edited',
            'code'  => 'edit',
            'color' => 'warning',
            'icon'  => 'pencil'
        ] );
        EntryAction::create( [
            'name'  => 'Reverted',
            'code'  => 'revert',
            'color' => 'danger',
            'icon'  => 'flash'
        ] );
        EntryAction::create( [
            'name'  => 'Deleted',
            'code'  => 'delete',
            'color' => 'default',
            'icon'  => 'remove'
        ] );
        EntryAction::create( [
            'name'  => 'Pending',
            'code'  => 'pending',
            'color' => 'primary',
            'icon'  => 'thumbs-up'
        ] );
        EntryAction::create( [
            'name'  => 'Accepted',
            'code'  => 'live',
            'color' => 'success',
            'icon'  => 'thumbs-up'
        ] );

    }
}