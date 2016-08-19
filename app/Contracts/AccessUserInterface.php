<?php

namespace App\Contracts;

use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

interface AccessUserInterface extends AuthorizableContract
{
    /**
     * Many-to-Many relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles();

    /**
     * Checks if the user has a role by its name.
     *
     * @param string|array $name Role name or array of role names.
     *
     * @return bool
     */
    public function hasRole($name);

    /**
     * Save the inputted roles.
     *
     * @param mixed $inputRoles
     *
     * @return void
     */
    public function saveRoles($inputRoles);

    /**
     * Alias to eloquent many-to-many relation's attach() method.
     *
     * @param mixed $role
     */
    public function attachRole($role);

    /**
     * Alias to eloquent many-to-many relation's detach() method.
     *
     * @param mixed $role
     */
    public function detachRole($role);

    /**
     * Attach multiple roles to a user.
     *
     * @param mixed $roles
     */
    public function attachRoles($roles);

    /**
     * Detach multiple roles from a user.
     *
     * @param mixed $roles
     */
    public function detachRoles($roles);

    /**
     * Checks whether the user has a certain role by it's code
     * It's possible to pass an array as $rolesToCheck - then the user must have at least one of the roles
     * @param $rolesToCheck
     * @return bool
     */
    public function hasRoleByCode($rolesToCheck);
}