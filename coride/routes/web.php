<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\TrajetController;
use App\Http\Controllers\ReservationController;
use App\Models\Trajet;
use App\Models\Reservation;
use App\Models\Employe;
use App\Models\Entreprise;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    $stats = [
        'trajets_count' => Trajet::count(),
        'entreprises_count' => Entreprise::count(),
        'employes_count' => Employe::count(),
        'reservations_count' => Reservation::count(),
    ];

    $trajetsRecents = Trajet::with(['conducteur.entreprise'])->latest()->take(5)->get();

    $mesReservations = $user ? Reservation::where('passager_id', $user->id)->with('trajet.conducteur')->latest()->take(5)->get() : collect();

    return view('dashboard', compact('stats', 'trajetsRecents', 'mesReservations'));
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('entreprises', EntrepriseController::class);
    Route::resource('employes', EmployeController::class);
    Route::resource('trajets', TrajetController::class);
    Route::resource('reservations', ReservationController::class);
    Route::patch('/reservations/{reservation}/status', [ReservationController::class, 'updateStatus'])->name('reservations.updateStatus');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';