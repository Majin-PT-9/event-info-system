<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'                  => 'required|string|max:255',
            'street'                => 'required|string|max:255',
            'house_number'          => 'required|integer',
            'house_number_addition' => 'string|nullable',
            'zip_code'              => 'required|string',
            'city'                  => 'required|string',
            'country_code'          => 'required|string|max:2',
            'phone'                 => 'string|nullable|max:255',
            'email'                 => 'string|email|nullable|max:255',
            'website'               => 'string|nullable|max:255',
        ];
    }
}
