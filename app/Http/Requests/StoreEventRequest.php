<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreEventRequest extends FormRequest
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
            'address_id'    => 'required|integer|exists:addresses,id',
            'name'          => 'required|string|max:255',
            'description'   => 'string|nullable',
            'starts_at'     => 'required|date|date_format:Y-m-d H:i:s',
            'ends_at'       => 'required|date|date_format:Y-m-d H:i:s|after:starts_at',
            'published'     => 'required|boolean'
        ];
    }
    /**
     * Handle a failed validation attempt.
     *
     * @param  Validator  $validator
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $response = response()->json([
            'success' => false,
            'message' => 'Validation failed.',
            'errors' => $errors->messages(),
            'missing_parameters' => array_keys($errors->messages())
        ], 422);

        throw new HttpResponseException($response);
    }
}
