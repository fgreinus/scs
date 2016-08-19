<?php

namespace App\Entities;

use App\Contracts\AccessUserInterface;
use App\Traits\AccessUserTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends BaseModel implements
    AuthenticatableContract,
    AuthorizableContract,
    AccessUserInterface
{
    use Authenticatable, Authorizable, AccessUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'ldapdn'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }

    public function entryLogs()
    {
        return $this->hasMany(EntryLog::class);
    }
}
