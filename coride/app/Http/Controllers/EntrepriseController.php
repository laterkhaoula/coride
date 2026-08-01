<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEntrepriseRequest;
use App\Models\Entreprise;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    public function index()
    {
        $entreprises = Entreprise::withCount('employes')->latest()->get();
        return view('entreprises.index', compact('entreprises'));
    }

    public function create()
    {
        return view('entreprises.create');
    }

    public function store(StoreEntrepriseRequest $request)
    {
        Entreprise::create($request->validated());

        return redirect()->route('entreprises.index')->with('success', 'Entreprise partenaire ajoutée avec succès.');
    }

    public function show(Entreprise $entreprise)
    {
        $entreprise->load('employes');
        return view('entreprises.show', compact('entreprise'));
    }

    public function edit(Entreprise $entreprise)
    {
        return view('entreprises.edit', compact('entreprise'));
    }

    public function update(Request $request, Entreprise $entreprise)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255', 'unique:entreprises,nom,' . $entreprise->id],
        ]);

        $entreprise->update($request->only('nom'));

        return redirect()->route('entreprises.index')->with('success', 'Entreprise mise à jour avec succès.');
    }

    public function destroy(Entreprise $entreprise)
    {
        $entreprise->delete();
        return redirect()->route('entreprises.index')->with('success', 'Entreprise supprimée avec succès.');
    }
}
