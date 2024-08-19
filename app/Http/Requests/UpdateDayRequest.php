<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDayRequest extends FormRequest
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
            'date' => 'required|date|after_or_equal:today',
        ];
    }
    public function messages()
    {
        return [
            'trip_id.required' => 'L\'ID del viaggio è obbligatorio.',
            'trip_id.exists' => 'Il viaggio selezionato non esiste.',
            'date.required' => 'La data della giornata è obbligatoria.',
            'date.date' => 'La data della giornata deve essere una data valida.',
            'date.after_or_equal' => 'La data della giornata deve essere oggi o successiva.',
        ];
    }
}
