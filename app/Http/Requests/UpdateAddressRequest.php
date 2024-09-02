<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
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
            'name'                  => 'string|max:255',
            'street'                => 'string|max:255',
            'house_number'          => 'integer',
            'house_number_addition' => 'string|nullable',
            'zip_code'              => 'string|max:255',
            'city'                  => 'string|max:255',
            'country_code'          => 'string|max:2',
            'phone'                 => 'string|nullable|max:255',
            'email'                 => 'string|email|nullable|max:255',
            'website'               => 'string|nullable|max:255',
        ];
    }
}
