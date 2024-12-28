<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
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
            'user_id' => 'required|numeric',
            'category_id' => 'required',
            'description' => 'required|string',
            'amount' => 'required|numeric',
            'currency' => 'required|string',
            'status' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'The category field is required'
        ];
    }
}
