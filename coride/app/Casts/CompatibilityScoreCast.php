<?php

namespace App\Casts;

use App\ValueObjects\CompatibilityResult;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class CompatibilityScoreCast implements CastsAttributes
{
    /**
     * Transform the attribute from the underlying model values into a CompatibilityResult object.
     *
     * @param  Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return CompatibilityResult
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): CompatibilityResult
    {
        $score = isset($attributes['score']) ? (int) $attributes['score'] : 0;
        $justification = $attributes['justification'] ?? 'Aucune justification calculée.';

        return new CompatibilityResult($score, $justification);
    }

    /**
     * Transform the CompatibilityResult object or array into values to store in the database.
     *
     * @param  Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return array
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): array
    {
        if ($value instanceof CompatibilityResult) {
            return [
                'score' => $value->score,
                'justification' => $value->justification,
            ];
        }

        if (is_array($value)) {
            return [
                'score' => (int) ($value['score'] ?? 0),
                'justification' => (string) ($value['justification'] ?? ''),
            ];
        }

        return [
            'score' => (int) $value,
            'justification' => $attributes['justification'] ?? '',
        ];
    }
}
