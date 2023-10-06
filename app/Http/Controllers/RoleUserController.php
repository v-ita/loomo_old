<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleUserRequest;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class RoleUserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Role/User/Create', [
            'users' => User::all(),
            'roles' => Role::where('enabled', true)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleUserRequest $request, User $user, Role $role)
    {
        // delete all others assigned role
        $allAssignedRoles = RoleUser::where('user_id', $user->id)->whereNot('role_id', $role->id)->get();
        foreach ($allAssignedRoles as $assignment) {
            $assignment->delete();
        }
        
        $roleUserExist = RoleUser::where('user_id', $user->id)->where('role_id', $role->id)->first();
        if (!$roleUserExist) {
            $roleUser = new RoleUser();
            
            $roleUser->createdBy()->associate(User::find(auth()->id()));
            $roleUser->role()->associate($role);
            $roleUser->user()->associate($user);

            $roleUser->save();
        }

        return redirect()->route(RouteServiceProvider::HOME);
    }
}
