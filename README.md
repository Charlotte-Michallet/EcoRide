# Projet EcoRide

<img src="EcoRide/public/assets/img/logo/logo.png" alt="Logo EcoRide" width="150"/>

EcoRide est une application web de covoiturage permettant de mettre en relation des conducteurs et des passagers pour des trajets en voiture, uniquement en France.

## Pré-requis :

Avant de lancer le projet avec Docker, assurez-vous d'avoir :

-   Docker et Docker Compose installés
-   Un système compatible avec Docker
-   Des ports libres pour le projet
-   Une connexion internet pour télécharger les images Docker

## Technologies utilisées :

#### Langage :

-   HTML5/ CSS3
-   JavaScript
-   PHP (POO, MVC) avec PDO

#### Frameworks et bibliothèques :

-   Tailwinds CSS
-   MerakiUI, HyperUI, PrelineIcon (Bibliothèques UI)
-   PhpMailer (envoi de mails)
-   Leaflet.js (Cartographie)
-   HeiGIT ( vérification des villes)
-   Nominatim (calcul d’itinéraires)
-   Chart.js ( graphique)

#### Base de données :

-   MYSQL (SQL)
-   MongoDB (NoSQL)

#### Ressources et medias :

-   Heroicons (icônes)
-   Unsplash, Freepik (banques d’images libres)
-   Gemini (illustrations générées par IA)

#### Conteneurisation et déploiement :

-   Docker
-   Nginx (server web)
-   Composer (gestion des dépendances)
-   Alwaysdata (Hébergement)

#### Autre :

-   Notion (gestion de projet)
-   Git, GitHub (versionning)

## Fonctionnalités :

#### Utilisateur

-   Inscription, connexion, et gestion de compte
-   Consultation et gestion des trajets
-   Consultation de l'historique des trajets

#### Chauffeur

-   Ajout ou suppression de voitures
-   Gestion des préférences de covoiturage
-   Création ou annulation de trajet
-   Mise à jour des trajets (démarrage, arrivée à destination)

#### Passager

-   Recherche de trajets avec filtre
-   Réservation ou annulation de trajets
-   Avis et notation des chauffeurs après un trajet

#### Employé

-   Gestion des avis des passagers
-   Suivi des trajets problématique

#### Administrateur

-   Gestion des comptes employés et utilisateurs
-   Visualisation de statistiques

## Variable d'environnement

Le projet utilise certaines variables d'environnement pour configurer les bases de données et d'autres paramètres.
Ces variables sont définies dans un fichier `.env`

Exemple de fichier `.env` :

```dotenv
# --- Configuration MySQL ---
ROOT_PWD = root_path
DB_NAME = db_name
DB_USER = username
DB_PWD = user_password
DB_PORTS = db_port
DB_HOST = db_host

# --- Configuration MongoDB ---
MONGO_USER = username
MONGO_PWD = user_password
MONGODB_PORT = db_port
MONGODB_HOST = db_host
MONGODB_NAME = db_name
AUTH_SOURCE = db_source

# --- Configuration nginx---
NGINX_PORTS = nginx_ports

# --- Configuration PHP Mailer ---
MAIL_HOST = mail_host
MAIL_ADRESS = votre_adresse@adress.com
MAIL_PWD = password
MAIL_PORT = port
```

## Installation :

Pour lancer le projet EcoRide en local, Docker doit être démarer sur votre machine.
Suivez les étapes ci-dessous :

1. Cloner le dépôt :

```bash
git clone https://github.com/Charlotte-Michallet/EcoRide.git
```

2. Se placer dans le dossier du projet
3. Lancer les conteneurs Docker

```bash
docker-compose up --build -d
```

4. Accéder à l'application via un navigateur

```bash
http://localhost:8000/
```

5. Pour arrêter les conteneurs

```bash
docker-compose down
```

## Port exposé

-   **Application web (Nginx)** : 80
-   **PHP-FPM** : 9000
-   **Base de données MySQL** : 3306
-   **Base de données MongoDB** : 27017

## Licence du projet :

Ce projet a été réalisé dans le cadre d'un projet étudiant. Il est destiné uniquement à l’évaluation académique par le corps enseignant.  
Toute réutilisation ou distribution par d’autres étudiants est strictement interdite.
Les bibliothèques, composants ou ressources tierces utilisées dans ce projet restent sous leur licence respective,
et leur utilisation est soumise aux conditions imposées par leurs auteurs.
