# 🚀 StartuPInvest - Equity Crowdfunding Platform

Bienvenue sur StartuPInvest, une plateforme moderne de financement participatif par actions conçue pour connecter les entrepreneurs ambitieux et les investisseurs.

## 🛠 Prérequis
- [Docker Desktop](https://www.docker.com/products/docker-desktop/) installé et lancé.

## 🏃‍♂️ Lancer l'application
1. Ouvrez un terminal dans le dossier du projet.
2. Démarrez les conteneurs :
   ```bash
   docker-compose up -d
   ```
3. **Initialisez les données de test** (uniquement la première fois ou après un reset) :
   ```bash
   docker exec -it startupinvest_app php seed.php
   ```

## 🔗 Liens d'accès
- **Application Web** : [http://localhost:8085/](http://localhost:8085/)
- **Base de données (phpMyAdmin)** : [http://localhost:8081/](http://localhost:8081/)
  - **Utilisateur** : `root`
  - **Mot de passe** : `root`

## 👥 Comptes de Test
Tous les comptes (sauf l'admin) utilisent le mot de passe : **`password123`**

- **Administrateur** : `admin` / `password`
- **Startuper** : `steve_jobs` ou `elon_musk`
- **Investisseur** : `warren_b`

## 📁 Structure du Projet
- `app/` : Logique MVC (Controllers, Models, Views).
- `config/` : Configuration de la base de données.
- `public/` : Point d'entrée de l'application et assets (CSS/JS).
- `Dockerfile` & `docker-compose.yml` : Configuration de l'environnement Docker.

## 🛑 Arrêter le projet
```bash
docker-compose down
```
