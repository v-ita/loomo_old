<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
	{
		$this->merge([
			'slug' => Str::slug($this->input('slug'))
		]);
	}

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'created_by' => ['nullable', 'integer', 'exists:App\Models\User,id'],
            'currency_id' => ['nullable', 'integer', 'exists:App\Models\Currency,id'],
            'category_id' => ['nullable', 'integer', 'exists:App\Models\Category,id'],
            'store_id' => ['nullable', 'integer', 'exists:App\Models\Store,id'],
            
            'name' => ['bail', 'string', 'required', 'max:255'],
            'slug' => ['bail', 'string', 'required', 'max:255', 'unique:products'],
            'description' => ['nullable', 'string'],
            
            'stock_quantity' => ['nullable', 'integer', 'min:0'],
            'unit_price' => ['nullable', 'decimal:0,2', 'min:0'],

            'status' => ['nullable', 'string', 'max:255'],
        ];
    }
}
