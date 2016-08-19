<?php

namespace App\Entities;

class EntryLog extends BaseModel
{
    protected $fillable = ['action_id', 'note', 'queries', 'revert_queries', 'entry_id', 'user_id', 'category_id', 'database_id'];

    protected $table = 'entrylogs';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function entry()
    {
        return $this->belongsTo(Entry::class, 'entry_id', 'id')->withTrashed();
    }

    public function action()
    {
        return $this->belongsTo(EntryAction::class, 'action_id', 'id');
    }
}
