<?php

namespace App\Entities;

class EntryAction extends BaseModel
{
    protected $fillable = [
        'code',
        'name',
        'color',
        'icon'
    ];

    protected $table = 'entryactions';

    public function logs()
    {
        return $this->hasMany(EntryLog::class, 'id', 'action_id');
    }

    public function states()
    {
        return $this->hasMany(EntryState::class, 'id', 'action_id');
    }
}
