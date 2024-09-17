<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'subtotal' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'grand_total' => 'required|numeric',

            'customer_id' => 'required',
            'customer_name' => 'required|string',
            'customer_phone' => 'nullable|string',
            'customer_email' => 'nullable|string',

            'details.*' => 'required|array|min:1',
            'details.*.product_unit_id' => 'required',
            'details.*.product_unit_name' => 'required',
            'details.*.quantity' => 'required',
            'details.*.price' => 'required'
        ];
    }
}
