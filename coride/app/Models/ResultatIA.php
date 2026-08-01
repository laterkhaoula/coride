<?php

namespace App\Models;

use App\Casts\CompatibilityScoreCast;
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

    protected $casts = [
        'compatibility' => CompatibilityScoreCast::class,
    ];

    public function trajet()
    {
        return $this->belongsTo(Trajet::class);
    }

    public function passager()
    {
        return $this->belongsTo(Employe::class, 'passager_id');
    }

    /**
     * Get or create a CompatibilityResult ValueObject for score and justification.
     */
    public function getCompatibilityAttribute(): \App\ValueObjects\CompatibilityResult
    {
        return new \App\ValueObjects\CompatibilityResult(
            (int) ($this->score ?? 0),
            $this->justification ?? 'Pas encore évalué.'
        );
    }
}
