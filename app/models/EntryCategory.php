<?php

class EntryCategory extends Eloquent
{

    protected $fillable = array( 'code', 'name' );

    protected $table = 'entrycategories';

    public function entries()
    {
        return $this->hasMany( 'Entry', 'id', 'category_id' );
    }

}