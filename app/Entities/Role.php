<?php
namespace App\Entities;

use App\Traits\AccessRoleTrait;
use App\Contracts\AccessRoleInterface as RoleContract;

class Role extends BaseModel implements RoleContract
{
    use AccessRoleTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'code', 'description'];
}