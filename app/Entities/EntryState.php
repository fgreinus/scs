<?php

namespace App\Entities;

class EntryState extends BaseModel
{

    protected $fillable = ['code', 'name', 'color'];

    protected $table = 'entrystates';

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }

    public function action()
    {
        return $this->belongsTo(EntryAction::class, 'action_id', 'id');
    }

}