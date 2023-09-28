<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttributeValueRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class AttributeValueController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Attribute/AddValue', [
            'attributes' => Attribute::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttributeValueRequest $request, Attribute $attribute)
    {
        $validated = $request->validated();
        $attributeValue = new AttributeValue($validated);
        
        $attributeValue->attribute()->associate($attribute);
        $attributeValue->createdBy()->associate(User::find(auth()->id()));

        $attributeValue->save();
        return redirect()->route(RouteServiceProvider::HOME);
    }
}
