<?php

namespace App\Http\Requests;

use App\Models\Employe;
use App\Models\Reservation;
use App\Models\Trajet;
use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'trajet_id' => ['required', 'exists:trajets,id'],
            'date_reservation' => ['required', 'date'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $trajetId = $this->input('trajet_id');
            $passager = auth()->user() ?? Employe::first();

            if (! $passager || ! $trajetId) {
                return;
            }

            $trajet = Trajet::find($trajetId);
            if (! $trajet) {
                return;
            }

            // Rule 4: Driver cannot reserve their own ride
            if ($trajet->conducteur_id === $passager->id) {
                $validator->errors()->add('trajet_id', 'Vous ne pouvez pas réserver votre propre trajet.');
                return;
            }

            // Rule 1: No duplicate reservation for the exact same ride
            $existing = Reservation::where('trajet_id', $trajet->id)
                ->where('passager_id', $passager->id)
                ->whereIn('statut', ['en_attente', 'confirmee'])
                ->exists();

            if ($existing) {
                $validator->errors()->add('trajet_id', 'Vous avez déjà une réservation active pour ce trajet.');
            }

            // Rule 2: Cannot exceed available seats count
            if ($trajet->placesRestantes() <= 0) {
                $validator->errors()->add('trajet_id', 'Ce trajet est complet, aucune place disponible restante.');
            }
        });
    }

    public function messages(): array
    {
        return [
            'trajet_id.required' => 'Le trajet est obligatoire.',
            'trajet_id.exists' => 'Le trajet sélectionné n\'existe pas.',
            'date_reservation.required' => 'La date de réservation est obligatoire.',
        ];
    }
}
