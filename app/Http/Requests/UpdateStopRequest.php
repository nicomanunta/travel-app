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
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'image_url' => 'nullable|url',
            'food' => 'nullable|string|max:255',
            'curiosities' => 'nullable|string',
        ];
    }
    public function messages()
    {
        return [
            'day_id.required' => 'L\'ID della giornata è obbligatorio.',
            'day_id.exists' => 'La giornata selezionata non esiste.',
            'title.required' => 'Il titolo della tappa è obbligatorio.',
            'title.string' => 'Il titolo della tappa deve essere una stringa.',
            'title.max' => 'Il titolo della tappa non può superare i 255 caratteri.',
            'latitude.required' => 'La latitudine della tappa è obbligatoria.',
            'latitude.numeric' => 'La latitudine deve essere un valore numerico.',
            'latitude.between' => 'La latitudine deve essere compresa tra -90 e 90.',
            'longitude.required' => 'La longitudine della tappa è obbligatoria.',
            'longitude.numeric' => 'La longitudine deve essere un valore numerico.',
            'longitude.between' => 'La longitudine deve essere compresa tra -180 e 180.',
            'image_url.url' => 'L\'URL dell\'immagine deve essere un URL valido.',
            'food.string' => 'Il campo cibo deve essere una stringa.',
            'food.max' => 'Il campo cibo non può superare i 255 caratteri.',
            'curiosities.string' => 'Il campo curiosità deve essere una stringa.',
        ];
    }
}
