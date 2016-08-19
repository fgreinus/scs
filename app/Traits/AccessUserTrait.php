<?php

namespace App\Traits;

use App\Entities\Role;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Collection;

trait AccessUserTrait
{
    use Authorizable;

    /**
     * Many-to-Many relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(config('access.role'), config('access.role_user_table'), config('access.user_foreign_key'), 'role_id');
    }

    /**
     * Boot the user model
     * Attach event listener to remove the many-to-many records when trying to delete
     * Will NOT delete any records if the user model uses soft deletes.
     *
     * @return void|bool
     */
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($user) {
            if (!method_exists(config('auth.model'), 'bootSoftDeletes')) {
                $user->roles()->sync([]);
            }

            return true;
        });
    }

    /**
     * Checks if the user has a role by its name.
     *
     * @param string|array $code Role code or array of role codes.
     *
     * @return bool
     */
    public function hasRole($code)
    {
        if (is_object($code)) {
            return $this->roles->contains('id', $code->id);
        }

        if (is_string($code)) {
            return $this->roles->contains('id', $code);
        }

        return (bool) (new Collection($code))->intersect($this->roles)->count();
    }

    /**
     * Save the inputted roles.
     *
     * @param mixed $inputRoles
     *
     * @return void
     */
    public function saveRoles($inputRoles)
    {
        if (!empty($inputRoles)) {
            $this->roles()->sync($inputRoles);
        } else {
            $this->roles()->detach();
        }
    }

    /**
     * Alias to eloquent many-to-many relation's attach() method.
     *
     * @param mixed $role
     */
    public function attachRole($role)
    {
        if (is_object($role)) {
            $role = $role->getKey();
        }
        if (is_array($role)) {
            $role = $role['id'];
        }

        if ($this->hasRole($role))
            return;

        $this->roles()->attach($role);
    }

    /**
     * Alias to eloquent many-to-many relation's detach() method.
     *
     * @param mixed $role
     */
    public function detachRole($role)
    {
        if (is_object($role)) {
            $role = $role->getKey();
        }
        if (is_array($role)) {
            $role = $role['id'];
        }

        if (!$this->hasRole($role))
            return;

        $this->roles()->detach($role);
    }

    /**
     * Attach multiple roles to a user.
     *
     * @param mixed $roles
     */
    public function attachRoles($roles)
    {
        foreach ($roles as $role) {
            $this->attachRole($role);
        }
    }

    /**
     * Detach multiple roles from a user.
     *
     * @param mixed $roles
     */
    public function detachRoles($roles = null)
    {
        if (!$roles) {
            $roles = $this->roles()->get();
        }

        foreach ($roles as $role) {
            $this->detachRole($role);
        }
    }

    /**
     * Checks whether the user has a certain role by it's code
     * It's possible to pass an array as $rolesToCheck - then the user must have at least one of the roles
     * @param $rolesToCheck
     * @return bool
     */
    public function hasRoleByCode($rolesToCheck)
    {
        if (!is_array($rolesToCheck)) {
            $rolesToCheck = [$rolesToCheck];
        }

        $roles = Role::whereIn('code', $rolesToCheck)->get();

        foreach ($roles as $role) {
            if ($this->hasRole($role))
                return true;
        }

        return false;
    }
}