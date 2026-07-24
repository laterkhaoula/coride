<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employe;
use App\Models\Entreprise;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $entreprises = Entreprise::all();
        return view('auth.register', compact('entreprises'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Employe::class],
            'entreprise_id' => ['required', 'exists:entreprises,id'],
            'ville_residence' => ['required', 'string', 'max:255'],
            'role' => ['required', 'in:conducteur,passager,les deux'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $employe = Employe::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'entreprise_id' => $request->entreprise_id,
            'ville_residence' => $request->ville_residence,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($employe));

        Auth::login($employe);

        return redirect(route('dashboard', absolute: false));
    }
}
