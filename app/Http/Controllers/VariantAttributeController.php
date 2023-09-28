<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVariantAttributeRequest;
use App\Models\AttributeValue;
use App\Models\User;
use App\Models\Variant;
use App\Models\VariantAttribute;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class VariantAttributeController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd( AttributeValue::all());
        return Inertia::render('Variant/Attribute/Create', [
            'variants' => Variant::with('product')->get(),
            'attributeValues' => AttributeValue::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVariantAttributeRequest $request, Variant $variant)
    {
        $validated = $request->validated();

        $variantAttribute = new VariantAttribute($validated);

        $variantAttribute->createdBy()->associate(User::find(auth()->id()));
        $variantAttribute->variant()->associate($variant);
        if (isset($validated['attribute_value_id'])) {
			$attributeValue = AttributeValue::find($validated['attribute_value_id']);
			$variantAttribute->attributeValue()->associate($attributeValue);
		}

        $variantAttribute->save();
        return redirect()->route(RouteServiceProvider::HOME);
    }
}
