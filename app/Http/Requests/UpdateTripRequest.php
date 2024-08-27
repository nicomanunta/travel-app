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
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
    public function messages(){
        return [
            'title.required' => 'Il campo titolo è obbligatorio.',
            'title.string' => 'Il titolo deve essere una stringa.',
            'title.max' => 'Il titolo non può superare i 255 caratteri.',
            'start_date.required' => 'Il campo data di inizio è obbligatorio.',
            'start_date.date' => 'Il campo data di inizio deve essere una data valida.',
            'end_date.required' => 'Il campo data di fine è obbligatorio.',
            'end_date.date' => 'Il campo data di fine deve essere una data valida.',
            'end_date.after_or_equal' => 'La data di fine deve essere uguale o successiva alla data di inizio.',
            'cover_image.image' => 'Il campo immagine di copertura deve essere un’immagine.',
            'cover_image.mimes' => 'L’immagine di copertura deve essere un file di tipo jpeg, png, jpg o gif.',
            'cover_image.max' => 'L’immagine di copertura non può superare i 2048 KB.',
        ];
    }
}
