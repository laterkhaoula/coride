<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employe extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $table = 'employes';

    protected $fillable = [
        'id',
        'nom',
        'email',
        'email_verified_at',
        'entreprise_id',
        'ville_residence',
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    public function trajets()
    {
        return $this->hasMany(Trajet::class, 'conducteur_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'passager_id');
    }

    public function resultsIA()
    {
        return $this->hasMany(ResultatIA::class, 'passager_id');
    }

    public function isConducteur()
    {
        return in_array($this->role, ['conducteur', 'les deux']);
    }

    public function isPassager()
    {
        return in_array($this->role, ['passager', 'les deux']);
    }
}
