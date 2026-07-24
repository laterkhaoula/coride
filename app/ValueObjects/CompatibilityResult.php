<?php

namespace App\ValueObjects;

use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

class CompatibilityResult implements Arrayable, JsonSerializable
{
    public int $score;
    public string $justification;

    public function __construct(int $score, string $justification)
    {
        $this->score = max(0, min(100, $score));
        $this->justification = $justification;
    }

    public function getBadgeClass(): string
    {
        if ($this->score >= 80) {
            return 'bg-emerald-100 text-emerald-800 border-emerald-300 dark:bg-emerald-950 dark:text-emerald-300 dark:border-emerald-800';
        } elseif ($this->score >= 60) {
            return 'bg-blue-100 text-blue-800 border-blue-300 dark:bg-blue-950 dark:text-blue-300 dark:border-blue-800';
        } elseif ($this->score >= 40) {
            return 'bg-amber-100 text-amber-800 border-amber-300 dark:bg-amber-950 dark:text-amber-300 dark:border-amber-800';
        } else {
            return 'bg-rose-100 text-rose-800 border-rose-300 dark:bg-rose-950 dark:text-rose-300 dark:border-rose-800';
        }
    }

    public function getBadgeLabel(): string
    {
        if ($this->score >= 80) {
            return 'Excellente compatibilité';
        } elseif ($this->score >= 60) {
            return 'Bonne compatibilité';
        } elseif ($this->score >= 40) {
            return 'Compatibilité moyenne';
        } else {
            return 'Faible compatibilité';
        }
    }

    public function toArray(): array
    {
        return [
            'score' => $this->score,
            'justification' => $this->justification,
            'badge_label' => $this->getBadgeLabel(),
            'badge_class' => $this->getBadgeClass(),
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
