<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVariantAttributeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'attribute_value_id' => ['required', 'integer', 'exists:App\Models\AttributeValue,id'],
            'extra_price' => ['nullable', 'decimal:0,2', 'min:0'],
            'enabled' => ['boolean', 'nullable'],
        ];
    }
}
