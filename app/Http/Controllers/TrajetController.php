<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrajetRequest;
use App\Http\Requests\UpdateTrajetRequest;
use App\Models\Trajet;
use App\Services\AiCompatibilityService;
use Illuminate\Http\Request;

class TrajetController extends Controller
{
    protected AiCompatibilityService $aiService;

    public function __construct(AiCompatibilityService $aiService)
    {
        $this->aiService = $aiService;
    }

    /**
     * Display a listing of the resource with AI compatibility calculation.
     */
    public function index(Request $request)
    {
        $query = Trajet::with(['conducteur.entreprise', 'reservations']);

        if ($request->filled('ville_depart')) {
            $query->where('ville_depart', 'like', '%' . $request->ville_depart . '%');
        }

        if ($request->filled('ville_arrivee')) {
            $query->where('ville_arrivee', 'like', '%' . $request->ville_arrivee . '%');
        }

        if ($request->filled('horaire')) {
            $query->where('horaire', 'like', '%' . $request->horaire . '%');
        }

        $trajets = $query->latest()->get();

        $currentUser = auth()->user();

        // Evaluate AI compatibility score for each ride if passenger
        if ($currentUser && $currentUser->isPassager()) {
            foreach ($trajets as $trajet) {
                if ($trajet->conducteur_id !== $currentUser->id) {
                    $this->aiService->evaluateCompatibility($currentUser, $trajet);
                }
            }
            // Reload with AI results
            $trajets->load(['resultsIA' => function ($q) use ($currentUser) {
                $q->where('passager_id', $currentUser->id);
            }]);
        }

        return view('trajets.index', compact('trajets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('trajets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTrajetRequest $request)
    {
        $conducteurId = auth()->id() ?? 1;

        $trajet = Trajet::create([
            'conducteur_id' => $conducteurId,
            'ville_depart' => $request->ville_depart,
            'ville_arrivee' => $request->ville_arrivee,
            'horaire' => $request->horaire,
            'places_disponibles' => $request->places_disponibles,
            'jours_recurrence' => $request->jours_recurrence,
        ]);

        return redirect()->route('trajets.index')->with('success', 'Trajet publié avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Trajet $trajet)
    {
        $trajet->load(['conducteur.entreprise', 'reservations.passager']);
        $currentUser = auth()->user();
        $aiResult = null;

        if ($currentUser && $currentUser->isPassager() && $trajet->conducteur_id !== $currentUser->id) {
            $aiResult = $this->aiService->evaluateCompatibility($currentUser, $trajet);
        }

        return view('trajets.show', compact('trajet', 'aiResult'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trajet $trajet)
    {
        return view('trajets.edit', compact('trajet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrajetRequest $request, Trajet $trajet)
    {
        $trajet->update($request->validated());

        return redirect()->route('trajets.show', $trajet)->with('success', 'Trajet mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     * Enforces Rule 3: Cannot delete a ride containing confirmed reservations.
     */
    public function destroy(Trajet $trajet)
    {
        $hasConfirmedReservations = $trajet->reservations()
            ->where('statut', 'confirmee')
            ->exists();

        if ($hasConfirmedReservations) {
            return redirect()->back()->with('error', 'Impossible de supprimer ce trajet car il contient des réservations confirmées.');
        }

        $trajet->delete();

        return redirect()->route('trajets.index')->with('success', 'Trajet supprimé avec succès.');
    }
}
