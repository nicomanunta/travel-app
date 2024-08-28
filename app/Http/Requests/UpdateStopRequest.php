<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStopRequest extends FormRequest
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'food' => 'nullable|string',
            'curiosities' => 'nullable|string',
            
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Il campo titolo è obbligatorio.',
            'title.string' => 'Il titolo deve essere una stringa.',
            'title.max' => 'Il titolo non può superare i 255 caratteri.',
            'image.image' => 'Il campo immagine deve essere un’immagine.',
            'image.mimes' => 'L’immagine deve essere di tipo jpeg, png, jpg o gif.',
            'image.max' => 'L’immagine non può superare i 2048 KB.',
        
        ];
    }
}
