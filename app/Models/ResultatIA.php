<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultatIA extends Model
{
    use HasFactory;

    protected $table = 'resultat_i_a_s';

    protected $fillable = [
        'id',
        'trajet_id',
        'passager_id',
        'score',
        'justification',
    ];

    public function trajet()
    {
        return $this->belongsTo(Trajet::class);
    }

    public function passager()
    {
        return $this->belongsTo(Employe::class, 'passager_id');
    }
}
