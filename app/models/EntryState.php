<?php

class EntryState extends Eloquent
{

    protected $fillable = array( 'code', 'name', 'color' );

    protected $table = 'entrystates';

    public function entries()
    {
        return $this->hasMany('Entry');
    }

    public function action()
    {
        return $this->belongsTo('EntryAction', 'action_id', 'id');
    }

}