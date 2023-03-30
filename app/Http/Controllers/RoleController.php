<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    // function permission_store(Request $request)
    // {
    //     Permission::create([
    //         'name' => $request->permission
    //     ]);

    //     return back();
    // }

    function role()
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('backend.role.role', [
            'permissions' => $permissions,
            'roles' => $roles,
        ]);
    }

    function role_store(Request $request)
    {
        $role = Role::create(['name' => $request->role]);
        $role->givePermissionTo($request->permission);
        return back();
    }

    function remove_role($role_id)
    {
        Role::find($role_id)->delete();
        return back();
    }

    function edit_role($role_id)
    {
        $permissions = Permission::all();
        $roles = Role::find($role_id);
        return view('backend.role.edit_role', [
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    function role_update(Request $request)
    {
        $role = Role::find($request->role_id);
        $role->syncPermissions($request->permission);
        return back();
    }

    function assign_role()
    {
        $users = User::all();
        $roles = Role::all();
        $permissions = Permission::all();
        return view('backend.role.assign_role', [
            'users' => $users,
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    function user_assign_role(Request $request)
    {
        $user = User::find($request->user_id);
        $user->assignRole($request->role_id);
        return back();
    }

    function remove_user_role($user_id)
    {
        $user = User::find($user_id);
        $user->syncRoles([]);
        $user->syncPermissions([]);

        return back();
    }

    function user_edit_permission($user_id)
    {
        $permissions = Permission::all();

        $users = User::find($user_id);
        $roles = $users->getRoleNames();
        return view('backend.role.edit_user_permission', [
            'permissions' => $permissions,
            'roles' => $roles,
            'users' => $users,
        ]);
    }


    function update_user_permission(Request $request)
    {
        $user = User::find($request->user_id);
        $user->syncPermissions($request->permission);

        return back();
    }
}
