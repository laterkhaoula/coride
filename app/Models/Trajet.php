<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'conducteur_id',
        'ville_depart',
        'ville_arrivee',
        'horaire',
        'places_disponibles',
        'jours_recurrence',
    ];

    public function conducteur()
    {
        return $this->belongsTo(Employe::class, 'conducteur_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function resultsIA()
    {
        return $this->hasMany(ResultatIA::class);
    }

    public function placesRestantes()
    {
        $reservees = $this->reservations()->where('statut', 'confirmee')->count();
        return max(0, $this->places_disponibles - $reservees);
    }
}
