<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDayRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'date' => 'required|date|after_or_equal:today',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Il campo titolo è obbligatorio.',
            'title.string' => 'Il titolo deve essere una stringa.',
            'title.max' => 'Il titolo non può superare i 255 caratteri.',
            'date.required' => 'La data della giornata è obbligatoria.',
            'date.date' => 'La data della giornata deve essere una data valida.',
            'date.after_or_equal' => 'La data della giornata deve essere oggi o successiva.',
        ];
    }

}
