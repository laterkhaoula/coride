<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Models\Reservation;
use App\Models\Trajet;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of reservations.
     */
    public function index()
    {
        $user = auth()->user();

        // Reservations made as passenger
        $mesReservations = Reservation::with(['trajet.conducteur'])
            ->where('passager_id', $user->id)
            ->latest()
            ->get();

        // Reservation demands received as driver
        $demandesRecues = Reservation::with(['passager', 'trajet'])
            ->whereHas('trajet', function ($q) use ($user) {
                $q->where('conducteur_id', $user->id);
            })
            ->latest()
            ->get();

        return view('reservations.index', compact('mesReservations', 'demandesRecues'));
    }

    /**
     * Store a newly created reservation in storage.
     */
    public function store(StoreReservationRequest $request)
    {
        $passager = auth()->user();

        Reservation::create([
            'trajet_id' => $request->trajet_id,
            'passager_id' => $passager->id,
            'date_reservation' => $request->date_reservation ?? now()->toDateString(),
            'statut' => 'en_attente',
        ]);

        return redirect()->route('reservations.index')->with('success', 'Votre demande de réservation a été envoyée au conducteur.');
    }

    /**
     * Update the reservation status (Confirmer, Refuser, Annuler).
     */
    public function updateStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'statut' => ['required', 'in:confirmee,refusee,annulee'],
        ]);

        $newStatut = $request->statut;
        $user = auth()->user();

        // If confirming, re-verify seat availability
        if ($newStatut === 'confirmee') {
            if ($reservation->trajet->placesRestantes() <= 0) {
                return redirect()->back()->with('error', 'Impossible de confirmer : aucune place disponible restante sur ce trajet.');
            }
        }

        $reservation->update(['statut' => $newStatut]);

        $message = match ($newStatut) {
            'confirmee' => 'La réservation a été confirmée.',
            'refusee' => 'La réservation a été refusée.',
            'annulee' => 'La réservation a été annulée.',
        };

        return redirect()->back()->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Réservation supprimée.');
    }
}
