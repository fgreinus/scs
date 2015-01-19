<?php

class AdminController extends BaseController
{

    public function overview() {

        $users = User::orderBy('id')->get();
        $roles = Role::orderBy('id')->get();
        return View::make('pages.admin.overview', [
            'sidebarDisabled' => true,
            'users' => $users,
            'roles' => $roles
        ]);
    }


    public function rolesSave($userId)
    {
        /** @var User $user */
        $user      = User::findOrFail($userId);
        $userRoles = $user->roles;
        $roles     = Input::get('roles');

        if (count($roles) < 1)
            return Redirect::route('admin')->withErrors(['error' => 'You must assign at least one role to a user.']);

        foreach ($userRoles as $role) {

            if (!in_array($role->id, $roles)) {
                $user->detachRole($role);
            } else if (isset($roles[array_search($role->id, $roles)])) {
                unset($roles[array_search($role->id, $roles)]);
            }
        }

        foreach ($roles as $role) {
            $user->attachRole($role);
        }

        return Redirect::route('admin');
    }

    public function roles() {

        $roles = Role::orderBy('name')
            ->with('perms')
            ->get();

        $permissions = Permission::orderBy('display_name')
            ->with('roles')
            ->get();

        $users = User::orderBy('username')
            ->get();

        return View::make('pages.admin.roles', [
            'sidebarDisabled' => true,
            'roles' => $roles,
            'permissions' => $permissions,
            'users' => $users
        ]);
    }

    public function saveRoles() {

        $roleSettings = Input::all();
        $rolePermissionMap = [];
        $roleObjs = Role::all();
        foreach ($roleObjs as $role)
            $rolePermissionMap[$role->id] = [];

        foreach ($roleSettings as $name => $setting) {

            if (strpos($name, 'rolepermission') === FALSE)
                continue;

            // parse role id and permission id out of input
            $exploded = explode("_", $name);
            $roleId = $exploded[1];
            $rolePermissionMap[$roleId][] = $exploded[2];
        }

        foreach ($rolePermissionMap as $roleId => $permissions) {
            /** @var Role $roleObj */
            $roleObj = null;
            foreach ($roleObjs as $role)
                if ($role->id == $roleId) {
                    $roleObj = $role;
                    break;
                }

            if (is_null($roleObj))
                continue;

            $roleObj->perms()->sync($permissions);

            $roleObj->save();
        }

        return Redirect::route('admin_roles')->withErrors(['success' => 'Roles and Permissions successfully saved.']);
    }

}