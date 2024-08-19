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
            'rating' => 'required|integer|min:1|max:5',
        ];
    }
    public function messages()
    {
        return [
            'stop_id.required' => 'L\'ID della tappa è obbligatorio.',
            'stop_id.exists' => 'La tappa selezionata non esiste.',
            'rating.required' => 'La valutazione è obbligatoria.',
            'rating.integer' => 'La valutazione deve essere un numero intero.',
            'rating.min' => 'La valutazione deve essere almeno 1.',
            'rating.max' => 'La valutazione non può essere superiore a 5.',
        ];
    }
}
