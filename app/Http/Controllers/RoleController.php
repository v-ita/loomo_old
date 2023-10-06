<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class RoleController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Role/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $validated = $request->validated();

        $role = new Role($validated);
        $role->createdBy()->associate(User::find(auth()->id()));
        $role->save();

        return redirect()->route(RouteServiceProvider::HOME);
    }
}
