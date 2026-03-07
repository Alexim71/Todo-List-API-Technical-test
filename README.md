# 📋 Task API Controller

Un contrôleur RESTful optimisé pour la gestion des tâches avec une gestion avancée des erreurs et des réponses JSON structurées.

![Laravel](https://img.shields.io/badge/Laravel-8%2B-FF2D20?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8%2B-777BB4?style=for-the-badge&logo=php)
![API](https://img.shields.io/badge/API-RESTful-00C7B7?style=for-the-badge&logo=api)

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

### ✅ 201 Created
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
