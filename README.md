# 📋 Task API Controller

RESTful-контроллер, оптимизированный для управления задачами, с расширенной обработкой ошибок и структурированными JSON-ответами.

![Laravel](https://img.shields.io/badge/Laravel-12.53.0%2B-FF2D20?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.5.3%2B-FF2D20?style=for-the-badge&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0.45%2B-4479A1?style=for-the-badge&logo=mysql)
![Composer](https://img.shields.io/badge/Composer-2.9.5%2B-885630?style=for-the-badge&logo=composer)
![API](https://img.shields.io/badge/API-RESTful-00C7B7?style=for-the-badge&logo=api)



## Средство
```bash
git clone [url]
cd todo-api
composer install
cp .env.example .env
# Настройте свою базу данных в .env
php artisan key:generate
php artisan migrate
php artisan serve


```

## 📝 Описание

Этот контроллер Laravel предоставляет полный API для управления задачами. :

| ✅ | 🛡️ | 📊 | 🔒 | 📝 | 🎯 |
|---|---|---|---|---|---|
| Операции CRUD | Обработка ошибок | Ответы JSON | Валидация |Тип безопасности |

## 🚀 Конечные точки

| Метод | URL | Описание | Code HTTP |
|---------|-----|-------------|-----------|
| `GET` | `/api/tasks` | Получить все задачи | `200` |
| `POST` | `/api/tasks` | Создать новую задачу | `201` |
| `GET` | `/api/tasks/{id}` | Получить конкретную задачу | `200` |
| `PUT` | `/api/tasks/{id}` | Обновить задачу | `200` |
| `DELETE` | `/api/tasks/{id}` | Удалить задачу | `200` |
| Бонусы | | |  |
| `PUT` | `/api/tasks/{id}` | Обновить задачу | `200` |
| `DELETE` | `/api/tasks/{id}` | Удалить задачу | `200` |
     

## 📦 Структура ответа
## Тестирование с помощью Postman
### ✅ 201 OK, store() → POST /api/tasks
```json
{
    "success": true,
    "data": {
        "title": "Моя задача3",
        "description": "Описание",
        "status": "на_удерживании",
        "updated_at": "2026-03-07T18:27:53.000000Z",
        "created_at": "2026-03-07T18:27:53.000000Z",
        "id": 3
    },
    "message": "Задача успешно создана"
}
```

### ✅ 200 OK, index() → GET /api/tasks
```json

{
    "success": true,
    "data": [
        {
            "id": 1,
            "title": "Измененная задача",
            "description": "Описание",
            "status": "В ходе выполнения",
            "created_at": "2026-03-06T18:10:37.000000Z",
            "updated_at": "2026-03-06T19:07:16.000000Z"
        },
        {
            "id": 2,
            "title": "Моя задача2",
            "description": "Описание",
            "status": "делать",
            "created_at": "2026-03-06T21:10:13.000000Z",
            "updated_at": "2026-03-06T21:10:13.000000Z"
        },
        {
            "id": 3,
            "title": "Моя задача3",
            "description": "Описание",
            "status": "en_attente",
            "created_at": "2026-03-07T18:27:53.000000Z",
            "updated_at": "2026-03-07T18:27:53.000000Z"
        }
    ],
    "message": "Задачи успешно восстановлены"
}

```

### ✅ 200 OK, show() → GET /api/tasks/{id}
```json
{
    "success": true,
    "data": {
        "id": 1,
        "title": "Измененная задача",
        "description": "Описание",
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
        "id": 3,
        "title": "Tâche modifiée4",
        "description": "Описание",
        "status": "в_ходе_выполнения",
        "created_at": "2026-03-07T18:27:53.000000Z",
        "updated_at": "2026-03-09T07:57:15.000000Z"
    },
    "message": "Задача успешно обновлена",
    "changes": {
        "title": {
            "old": "Tâche modifiée",
            "new": "Tâche modifiée4"
        }
    }
}
```

### ✅ 200 OK, destroy() → DELETE /api/tasks/{id}
```json
{
    "success": true,
    "message": "Задача успешно удалена"
}
