# CoRide - Architecture de la Brique d'Intelligence Artificielle & Custom Eloquent Cast

Ce document détaille la conception, le fonctionnement et l'intégration de la brique d'intelligence artificielle de la plateforme **CoRide**.

---

## 1. Vision et Objectifs de l'IA CoRide

Contrairement aux systèmes traditionnels d'uniquement filtrer par égalité stricte de chaîne de caractères sur la ville ou l'horaire, la brique IA de **CoRide** réalise un calcul de **compatibilité contextuelle réelle** entre les besoins d'un salarié passager et la proposition d'un conducteur.

L'IA prend en compte trois dimensions fondamentales :
1. **Proximité de l'Itinéraire** : Analyse géographique (ville de résidence du passager, point de départ du trajet, destination finale).
2. **Alignement Horaire** : Correspondance entre l'heure habituelle d'embauche/déplacement du salarié et l'horaire affiché du conducteur.
3. **Régularité & Récurrence** : Fréquence des jours d'activité (Lundi-Vendredi, télétravail ponctuel, etc.).

---

## 2. Architecture Logicielle & Eloquent Cast

La brique d'IA est intégrée nativement dans l'architecture MVC de Laravel à l'aide des composants suivants :

```
       [ Employe (Passager) + Trajet ]
                     │
                     ▼
          [ AiCompatibilityService ]
                     │ (Évaluation 3 dimensions)
                     ▼
          [ CompatibilityResult (Value Object) ]
                     │
                     ▼
          [ CompatibilityScoreCast ] ◄──── Custom Eloquent Cast
                     │
                     ▼
          [ ResultatIA (Base de Données) ]
```

### A. Le Value Object `CompatibilityResult`
Contient les propriétés immutables et les helpers de rendu de l'interface graphique :
- `score` (integer entre 0 et 100)
- `justification` (string explicatif rédigé)
- `getBadgeClass()` : Retourne les classes Tailwind assorties (ex: `bg-emerald-100` pour un score >= 80, `bg-amber-100` pour >= 40, `bg-rose-100` sinon).
- `getBadgeLabel()` : Libellé synthétique (ex: "Excellente compatibilité").

### B. Le Custom Eloquent Cast `CompatibilityScoreCast`
Implémente `Illuminate\Contracts\Database\Eloquent\CastsAttributes`. Il convertit la combinaison des colonnes DB `score` et `justification` en une instance du Value Object `CompatibilityResult` lors de l'accès à l'attribut `$resultat->compatibility`.

```php
protected $casts = [
    'compatibility' => CompatibilityScoreCast::class,
];
```

---

## 3. Algorithme de Scoring & Génération de la Justification

### Formule de Calcul du Score :
$$\text{Score Total} = \min(100, \text{Score Proximité (Max 45)} + \text{Score Horaire (Max 30)} + \text{Score Récurrence (Max 25)})$$

1. **Proximité (Max 45 pts)** :
   - Ville de résidence === Ville de départ : **45 pts**
   - Ville de résidence === Ville d'arrivée : **40 pts**
   - Villes limitrophes / zone métropolitaine : **25 pts**

2. **Horaire (Max 30 pts)** :
   - Heure de trajet idéale pour le créneau du matin (07h00 - 09h00) : **30 pts**

3. **Récurrence (Max 25 pts)** :
   - Recurrence complète Lundi à Vendredi : **25 pts**
   - Recurrence partielle (3-4 jours) : **18 pts**
   - Recurrence occasionnelle : **12 pts**

### Génération de la Justification Naturelle :
L'IA génère dynamiquement une explication claire et naturelle affichée directement dans la vue du trajet, permettant au passager d'avoir une parfaite transparence sur la pertinence du covoiturage.

---

## 4. Affichage dans les Vues Blade

Dans `resources/views/trajets/index.blade.php` et `resources/views/trajets/show.blade.php`, le score et la justification sont directement restitués grâce aux méthodes du Value Object :

```html
<div class="p-4 rounded-2xl border {{ $aiResult->getBadgeClass() }}">
    <span class="font-black text-sm">Score IA: {{ $aiResult->score }}%</span>
    <p class="text-xs mt-1">{{ $aiResult->justification }}</p>
</div>
```
