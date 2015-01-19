<?php

/**
 * Created by PhpStorm.
 * User: Dude
 * Date: 26.07.14
 * Time: 17:23
 */
class EntryAction extends Eloquent
{
    protected $fillable = array(
        'code',
        'name',
        'color',
        'icon'
    );

    protected $table = 'entryactions';

    public function logs()
    {
        return $this->hasMany( 'EntryLog', 'id', 'action_id' );
    }

    public function states()
    {
        return $this->hasMany('EntryState', 'id', 'action_id');
    }
}
