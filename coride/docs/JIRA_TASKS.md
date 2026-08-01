# CoRide - Planification des Tâches Jira (Backlog & Sprints)

Ce document résume le backlog du projet **CoRide**, découpé en Epics, User Stories, critères d'acceptation et chiffrage en Story Points.

---

## 🚀 Epic 1 : Gestion des Entreprises & Salariés (Auth & Profils)

### US-101 : Authentification Salariés & Entreprises Partenaires
- **Description** : En tant que salarié d'une entreprise partenaire, je veux m'inscrire et me connecter avec mon email professionnel afin d'accéder à la plateforme CoRide.
- **Entreprises incluses** : MobiliTech, NextBuild, Atlas Digital, GreenLogix, Kandia Solutions.
- **Critères d'Acceptation** :
  1. L'inscription demande le nom, l'email, la sélection d'une entreprise partenaire, la ville de résidence et le rôle (conducteur, passager, les deux).
  2. L'email professionnel doit être unique dans la base de données.
  3. L'authentification utilise Laravel Breeze adaptée au modèle `Employe`.
- **Estimation** : 5 Story Points

---

## 🚘 Epic 2 : Offres de Covoiturage (Trajets Conducteurs)

### US-201 : Publication d'un Trajet
- **Description** : En tant que conducteur, je veux publier un trajet avec mes villes de départ/arrivée, horaire, nombre de places et jours de récurrence.
- **Critères d'Acceptation** :
  1. Validation FormRequest : tous les champs obligatoires, places > 0.
  2. Le trajet est rattaché au salarié connecté avec rôle `conducteur` ou `les deux`.
- **Estimation** : 3 Story Points

### US-202 : Interdiction de Suppression avec Réservations Confirmées (Règle Métier 3)
- **Description** : En tant que conducteur, je ne dois pas pouvoir supprimer un trajet si celui-ci contient au moins une réservation confirmée.
- **Critères d'Acceptation** :
  1. La méthode `destroy()` vérifie si au moins une réservation est au statut `confirmee`.
  2. Un message d'erreur explicite est renvoyé si la condition n'est pas respectée.
- **Estimation** : 3 Story Points

---

## 🎟️ Epic 3 : Réservations & Workflow Passagers/Conducteurs

### US-301 : Réservation d'une Place par un Passager
- **Description** : En tant que passager, je veux rechercher un trajet et réserver une place disponible.
- **Critères d'Acceptation** :
  1. Règle Métier 1 : Interdiction de réserver 2 fois le même trajet.
  2. Règle Métier 2 : Interdiction de dépasser le nombre de places disponibles (`placesRestantes() > 0`).
  3. Règle Métier 4 : Le conducteur ne peut pas réserver son propre trajet.
- **Estimation** : 5 Story Points

### US-302 : Validation et Gestion du Statut des Réservations
- **Description** : En tant que conducteur ou passager, je veux gérer et suivre le statut de la réservation (`en_attente`, `confirmee`, `refusee`, `annulee`).
- **Estimation** : 5 Story Points

---

## 🧠 Epic 4 : Brique d'Intelligence Artificielle & Eloquent Cast

### US-401 : Analyse de Compatibilité IA Multi-Critères
- **Description** : En tant que passager, je veux voir pour chaque trajet un score de compatibilité (0-100%) et une justification naturelle générée par l'IA CoRide.
- **Critères d'Acceptation** :
  1. Analyse de la proximité d'itinéraire (ville de résidence vs départ/arrivée).
  2. Analyse de l'alignement des horaires et de la récurrence des jours.
  3. Stockage en base via un Custom Eloquent Cast (`CompatibilityScoreCast` & ValueObject `CompatibilityResult`).
  4. Affichage d'un badge couleur et d'une explication dans les vues Blade.
- **Estimation** : 8 Story Points

---

## 📊 Récapitulatif du Sprint Backlog

| Ticket ID | Titre | Epic | Statut | Story Points |
| :--- | :--- | :--- | :--- | :--- |
| **US-101** | Auth Salariés & Entreprises Partenaires | Profils | Terminé | 5 SP |
| **US-201** | Publication d'un Trajet | Trajets | Terminé | 3 SP |
| **US-202** | Contrainte suppression trajet | Trajets | Terminé | 3 SP |
| **US-301** | Réservation & Règles métier | Réservations | Terminé | 5 SP |
| **US-302** | Workflow des Statuts de Réservation | Réservations | Terminé | 5 SP |
| **US-401** | Engine IA & Custom Eloquent Cast | IA CoRide | Terminé | 8 SP |
| **TOTAL** | | | | **29 Story Points** |
