<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCurrencyRequest extends FormRequest
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
            'name' => ['bail', 'string', 'required', 'max:255'],
            'iso_code' => ['bail', 'string', 'required', 'max:255', 'unique:currencies'],
            
            'symbol' => ['nullable', 'string', 'max:255'],
            'symbol_position' => ['nullable', 'string', 'max:255'],

            'enabled' => ['boolean', 'nullable']
        ];
    }
}
