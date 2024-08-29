<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStopRequest extends FormRequest
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
            'location' => 'nullable|string|max:255',  
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Il titolo della tappa è obbligatorio.',
            'title.string' => 'Il titolo della tappa deve essere una stringa.',
            'title.max' => 'Il titolo della tappa non può superare i 255 caratteri.',
            'image.image' => 'Il campo immagine deve essere un’immagine.',
            'image.mimes' => 'L’immagine deve essere di tipo jpeg, png, jpg o gif.',
            'image.max' => 'L’immagine non può superare i 2048 KB.',
            'food.string' => 'Il campo cibo deve essere una stringa.',
            'curiosities.string' => 'Il campo curiosità deve essere una stringa.',
            'location.string' => 'Il campo località deve essere una stringa.',
            'location.max' => 'Il campo località non può superare i 255 caratteri.',
        ];
    }

}
