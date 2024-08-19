<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTripRequest extends FormRequest
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
            'description' => 'nullable|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ];
    }
    public function messages(){
        return [
            'title.required' => 'Il titolo del viaggio è obbligatorio.',
            'title.string' => 'Il titolo deve essere una stringa.',
            'title.max' => 'Il titolo non può superare i 255 caratteri.',
            'start_date.required' => 'La data di inizio è obbligatoria.',
            'start_date.date' => 'La data di inizio deve essere una data valida.',
            'start_date.after_or_equal' => 'La data di inizio deve essere oggi o successiva.',
            'end_date.required' => 'La data di fine è obbligatoria.',
            'end_date.date' => 'La data di fine deve essere una data valida.',
            'end_date.after_or_equal' => 'La data di fine deve essere uguale o successiva alla data di inizio.',
        ];
    }
}
