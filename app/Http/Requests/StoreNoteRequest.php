<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoteRequest extends FormRequest
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
            'content' => 'required|string',
        ];
    }
    public function messages()
    {
        return [
            'stop_id.required' => 'L\'ID della tappa è obbligatorio.',
            'stop_id.exists' => 'La tappa selezionata non esiste.',
            'content.required' => 'Il contenuto della nota è obbligatorio.',
            'content.string' => 'Il contenuto della nota deve essere una stringa.',
            'content.max' => 'Il contenuto della nota non può superare i 1000 caratteri.',
        ];
    }

}
