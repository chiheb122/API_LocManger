<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# API de Location de Matériel Sportif

Cette API en Laravel permet la gestion de la location de matériel sportif pour des utilisateurs. Elle fournit des fonctionnalités telles que la gestion des utilisateurs, l’inventaire des équipements, et le suivi des réservations et retours.

## Fonctionnalités

- **Gestion des utilisateurs** : Inscription, connexion, et gestion des profils d’utilisateurs.
- **Catalogue de matériel** : Consultation de l’inventaire de matériel sportif avec catégories et filtres.
- **Gestion des réservations** : Permet aux utilisateurs de louer des équipements sportifs, de planifier la durée de location et de vérifier la disponibilité.


## Prérequis

- **PHP >= 8.1**
- **Composer** pour gérer les dépendances PHP
- **MySQL** ou un autre système de gestion de base de données compatible
- **Postman** ou un autre client API pour tester les endpoints

## Installation

1. Clonez le dépôt du projet :

   ```bash
   git clone https://github.com/nom_utilisateur/location-materiel-sport.git
   cd location-materiel-sport
   ```

2. Installez les dépendances PHP :

   ```bash
   composer install
   ```


3. Exécutez les migrations de base de données :

   ```bash
   php artisan migrate
   ```

4. (Facultatif) Ajoutez des données de démonstration :

   ```bash
   php artisan db:seed
   ```

5. Lancez le serveur de développement :

   ```bash
   php artisan serve
   ```

L'API sera disponible sur `http://localhost:8000`.




