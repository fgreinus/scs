<?php

namespace App\Entities;

class EntryDatabase extends BaseModel
{
    protected $fillable = [
        'name',
        'connect',
        'username',
        'password',
        'port'
    ];

    protected $table = 'entrydatabases';

    public function entries()
    {
        return $this->hasMany(Entry::class, 'id', 'database_id');
    }
}
