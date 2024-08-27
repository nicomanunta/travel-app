<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRatingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'value' => 'required|integer|between:1,5',
        ];
    }
    public function messages()
    {
        return [
            'value.required' => 'Il campo valore è obbligatorio.',
            'value.integer' => 'Il valore deve essere un numero intero.',
            'value.between' => 'Il valore deve essere compreso tra 1 e 5.',
        ];
    }
}
