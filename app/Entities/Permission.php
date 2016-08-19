<?php
namespace App\Entities;
use App\Traits\AccessPermissionTrait;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\AccessPermissionInterface as PermissionContract;

class Permission extends Model implements PermissionContract
{
    use AccessPermissionTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];
}