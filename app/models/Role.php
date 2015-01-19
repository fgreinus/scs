<?php

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    /**
     * Lookup whether the role has a specific permission
     * @param $permissionId
     *
     * @return bool
     */
    public function hasPermission($permissionId) {

        foreach ($this->perms as $permission)
            if ($permission->id == $permissionId)
                return true;

        return false;
    }
}