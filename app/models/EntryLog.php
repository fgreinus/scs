<?php
/**
 * Created by PhpStorm.
 * User: Dude
 * Date: 26.07.14
 * Time: 17:38
 */

class EntryLog extends Eloquent
{
    protected $fillable = ['action_id', 'note', 'queries', 'revert_queries', 'entry_id', 'user_id', 'category_id', 'database_id'];

    protected $table = 'entrylogs';

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function entry()
    {
        return $this->belongsTo('Entry', 'entry_id', 'id')->withTrashed();
    }

    public function action()
    {
        return $this->belongsTo('EntryAction', 'action_id', 'id');
    }
}
