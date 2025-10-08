<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'payment_method' => 'required',
            'total' => 'required',
            'order_items' => 'required|array',
            'order_items.*.product_id' => 'required|exists:products,id|integer',
            'order_items.*.product_name' => 'required|exists:products,name',
            'order_items.*.quantity' => 'required',
            'order_items.*.sub_total' => 'required',
        ];
    }
}
