# 📋 Task API Controller

Un contrôleur RESTful optimisé pour la gestion des tâches avec une gestion avancée des erreurs et des réponses JSON structurées.

![Laravel](https://img.shields.io/badge/Laravel-12.53.0%2B-FF2D20?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.5.3%2B-FF2D20?style=for-the-badge&logo=php)
![API](https://img.shields.io/badge/API-RESTful-00C7B7?style=for-the-badge&logo=api)


## Prérequis
- PHP 8.1+
- Composer
- MySQL

## Installation
```bash
git clone [votre-repo]
cd todo-api
composer install
cp .env.example .env
# Configurez votre base de données dans .env
php artisan key:generate
php artisan migrate
php artisan serve

## 📝 Description

Ce contrôleur Laravel fournit une API complète pour la gestion des tâches avec :

| ✅ | 🛡️ | 📊 | 🔒 | 📝 | 🎯 |
|---|---|---|---|---|---|
| Opérations CRUD | Gestion d'erreurs | Réponses JSON | Validation |Type safety |

## 🚀 Endpoints

| Méthode | URL | Description | Code HTTP |
|---------|-----|-------------|-----------|
| `GET` | `/api/tasks` | Récupérer toutes les tâches | `200` |
| `POST` | `/api/tasks` | Créer une nouvelle tâche | `201` |
| `GET` | `/api/tasks/{id}` | Récupérer une tâche spécifique | `200` |
| `PUT` | `/api/tasks/{id}` | Mettre à jour une tâche | `200` |
| `DELETE` | `/api/tasks/{id}` | Supprimer une tâche | `200` |

## 📦 Structure des réponses
## Test avec Postman
### ✅ 201 OK, store() → POST /api/tasks
```json
{
    "success": true,
    "data": {
        "title": "Ma tâche3",
        "description": "Description",
        "status": "en_attente",
        "updated_at": "2026-03-07T18:27:53.000000Z",
        "created_at": "2026-03-07T18:27:53.000000Z",
        "id": 3
    },
    "message": "Tâche créée avec succès"
}
```

### ✅ 200 OK, index() → GET /api/tasks
```json

{
    "success": true,
    "data": [
        {
            "id": 1,
            "title": "Tâche modifiée",
            "description": "Description",
            "status": "En cours",
            "created_at": "2026-03-06T18:10:37.000000Z",
            "updated_at": "2026-03-06T19:07:16.000000Z"
        },
        {
            "id": 2,
            "title": "Ma tâche2",
            "description": "Description",
            "status": "à faire",
            "created_at": "2026-03-06T21:10:13.000000Z",
            "updated_at": "2026-03-06T21:10:13.000000Z"
        },
        {
            "id": 3,
            "title": "Ma tâche3",
            "description": "Description",
            "status": "en_attente",
            "created_at": "2026-03-07T18:27:53.000000Z",
            "updated_at": "2026-03-07T18:27:53.000000Z"
        }
    ],
    "message": "Tâches récupérées avec succès"
}

```

### ✅ 200 OK, show() → GET /api/tasks/{id}
```json
{
    "success": true,
    "data": {
        "id": 1,
        "title": "Tâche modifiée",
        "description": "Description",
        "status": "En cours",
        "created_at": "2026-03-06T18:10:37.000000Z",
        "updated_at": "2026-03-06T19:07:16.000000Z"
    }
}

```

### ✅ 200 OK, update() → PUT /api/tasks/{id}
```json

{
    "success": true,
    "data": {
        "id": 1,
        "title": "Tâche modifiée",
        "description": "Description",
        "status": "En cours",
        "created_at": "2026-03-06T18:10:37.000000Z",
        "updated_at": "2026-03-06T19:07:16.000000Z"
    },
    "message": "Tâche mise à jour avec succès"
}
```

### ✅ 200 OK, destroy() → DELETE /api/tasks/{id}
```json
{
    "success": true,
    "message": "Tâche supprimée avec succès"
}
