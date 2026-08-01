<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeRequest;
use App\Models\Employe;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeController extends Controller
{
    public function index()
    {
        $employes = Employe::with('entreprise')->latest()->get();
        return view('employes.index', compact('employes'));
    }

    public function create()
    {
        $entreprises = Entreprise::all();
        return view('employes.create', compact('entreprises'));
    }

    public function store(StoreEmployeRequest $request)
    {
        Employe::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'entreprise_id' => $request->entreprise_id,
            'ville_residence' => $request->ville_residence,
            'role' => $request->role,
            'password' => Hash::make($request->password ?? 'password'),
        ]);

        return redirect()->route('employes.index')->with('success', 'Employé créé avec succès.');
    }

    public function show(Employe $employe)
    {
        $employe->load(['entreprise', 'trajets', 'reservations.trajet']);
        return view('employes.show', compact('employe'));
    }

    public function edit(Employe $employe)
    {
        $entreprises = Entreprise::all();
        return view('employes.edit', compact('employe', 'entreprises'));
    }

    public function update(Request $request, Employe $employe)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:employes,email,' . $employe->id],
            'entreprise_id' => ['required', 'exists:entreprises,id'],
            'ville_residence' => ['required', 'string', 'max:255'],
            'role' => ['required', 'in:conducteur,passager,les deux'],
        ]);

        $employe->update($request->only(['nom', 'email', 'entreprise_id', 'ville_residence', 'role']));

        return redirect()->route('employes.index')->with('success', 'Employé mis à jour avec succès.');
    }

    public function destroy(Employe $employe)
    {
        $employe->delete();
        return redirect()->route('employes.index')->with('success', 'Employé supprimé avec succès.');
    }
}
