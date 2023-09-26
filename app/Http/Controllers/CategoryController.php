<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Category/Create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    { 
        $validated = $request->validated();

        $category = new Category($validated);

        if (isset($validated['parent_id'])) {
			$parent = Category::find($validated['parent_id']);
			$category->parent()->associate($parent);
		}
        $category->createdBy()->associate(User::find(auth()->id()));

        $category->save();

        return redirect()->route(RouteServiceProvider::HOME);
    }
}
