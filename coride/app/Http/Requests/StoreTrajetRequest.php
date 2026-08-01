<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrajetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ville_depart' => ['required', 'string', 'max:255'],
            'ville_arrivee' => ['required', 'string', 'max:255'],
            'horaire' => ['required', 'string', 'max:255'],
            'places_disponibles' => ['required', 'integer', 'min:1', 'max:8'],
            'jours_recurrence' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'ville_depart.required' => 'La ville de départ est obligatoire.',
            'ville_arrivee.required' => 'La ville d\'arrivée est obligatoire.',
            'horaire.required' => 'L\'horaire est obligatoire.',
            'places_disponibles.required' => 'Le nombre de places disponibles est obligatoire.',
            'places_disponibles.min' => 'Il doit y avoir au moins 1 place disponible.',
            'jours_recurrence.required' => 'Les jours de récurrence sont obligatoires.',
        ];
    }
}
