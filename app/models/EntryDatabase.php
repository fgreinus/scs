<?php

class EntryDatabase extends Eloquent
{
    protected $fillable = array(
        'name',
        'connect',
        'username',
        'password',
        'port'
    );

    protected $table = 'entrydatabases';

    public function entries()
    {
        return $this->hasMany( 'Entry', 'id', 'database_id' );
    }
}
