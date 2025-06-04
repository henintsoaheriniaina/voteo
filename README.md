# Voteo

Voteo est une application de questions/réponses avec votes en temps réel, conçue pour explorer et apprendre les concepts de communication instantanée et d'architecture moderne.

## Stack technique

- **Backend** : [Laravel](https://laravel.com/) avec [Sanctum](https://laravel.com/docs/10.x/sanctum) pour l'authentification API
- **Frontend** : [Vue 3](https://vuejs.org/) + [Pinia](https://pinia.vuejs.org/) + [Vue Router](https://router.vuejs.org/)
- **Temps réel** : [Pusher](https://pusher.com/) & [Laravel Echo](https://laravel.com/docs/10.x/broadcasting)
- **Gestion des paquets frontend** : [pnpm](https://pnpm.io/)

## Fonctionnalités

- Authentification sécurisée via Laravel Sanctum
- Création de questions et réponses
- Système de votes en temps réel
- Notifications instantanées via Pusher/Echo
- Interface moderne et réactive avec Vue 3

## Installation

### Backend (Laravel)

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

### Frontend (Vue 3)

```bash
cd frontend
pnpm install
pnpm run dev
```

## Configuration

- Configurez les variables d'environnement pour Pusher dans `.env` (backend) et `.env` (frontend si nécessaire).
- Assurez-vous que le backend et le frontend pointent vers les bonnes URLs/API.

## Contribution

Les contributions sont les bienvenues ! Ouvrez une issue ou une pull request.
