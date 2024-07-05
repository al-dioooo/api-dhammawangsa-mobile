<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCartRequest extends FormRequest
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
            'user_id' => 'required|string',

            'product_model_id' => 'required|string|max:20',
            'product_model_name' => 'required|string|max:100',

            'product_unit_id' => 'required|string|max:20',
            'product_unit_name' => 'required|string|max:100',

            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric'
        ];
    }
}
