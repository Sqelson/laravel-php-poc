<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetShipmentRateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // For this example, will allow all requests. Adjust as needed.
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
            // The weight must be a positive number and cannot exceed 1000kg.
            'weight' => 'required|numeric|min:0|max:1000',
        ];
    }
}
