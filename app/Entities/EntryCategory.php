<?php

namespace App\Entities;

class EntryCategory extends BaseModel
{
    protected $fillable = ['code', 'name'];

    protected $table = 'entrycategories';

    public function entries()
    {
        return $this->hasMany(Entry::class, 'id', 'category_id');
    }

}