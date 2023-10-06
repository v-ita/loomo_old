<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRoleRequest;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class PermissionRoleController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Role/Permission/Create', [
            'permissions' => Permission::all(),
            'roles' => Role::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRoleRequest $request, Role $role, Permission $permission)
    {
        $permissionRoleExist = PermissionRole::where('role_id', $role->id)->where('permission_id', $permission->id)->first();
        if (!$permissionRoleExist) {
            $permissionRole = new PermissionRole();

            $permissionRole->createdBy()->associate(User::find(auth()->id()));
            $permissionRole->permission()->associate($permission);
            $permissionRole->role()->associate($role);
            
            $permissionRole->save();
        }

        return redirect()->route(RouteServiceProvider::HOME);
    }
}
