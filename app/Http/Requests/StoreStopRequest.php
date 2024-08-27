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
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Il titolo della tappa è obbligatorio.',
            'title.string' => 'Il titolo della tappa deve essere una stringa.',
            'title.max' => 'Il titolo della tappa non può superare i 255 caratteri.',
            'latitude.required' => 'La latitudine della tappa è obbligatoria.',
            'latitude.numeric' => 'La latitudine deve essere un valore numerico.',
            'latitude.between' => 'La latitudine deve essere compresa tra -90 e 90.',
            'longitude.required' => 'La longitudine della tappa è obbligatoria.',
            'longitude.numeric' => 'La longitudine deve essere un valore numerico.',
            'longitude.between' => 'La longitudine deve essere compresa tra -180 e 180.',
            'image.image' => 'Il campo immagine deve essere un’immagine.',
            'image.mimes' => 'L’immagine deve essere di tipo jpeg, png, jpg o gif.',
            'image.max' => 'L’immagine non può superare i 2048 KB.',
            'food.string' => 'Il campo cibo deve essere una stringa.',
            'curiosities.string' => 'Il campo curiosità deve essere una stringa.',
        ];
    }

}
