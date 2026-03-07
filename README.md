# Todo List API

REST API to manage a task list developed with Laravel.

## Prerequisites
- PHP 8.5.3 
- Composer version 2.9.5
- MySQL version 8.0.45

## Installation
```bash
git clone https://github.com/Alexim71/Todo-List-API-Technical-test.git
cd todo-api
composer install
cp .env.example .env
# Configure your database in .env
php artisan key:generate
php artisan migrate
php artisan serve



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task API Controller - Documentation</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            line-height: 1.6;
            color: #24292e;
            background-color: #f6f8fa;
            padding: 0;
            margin: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 3rem 2rem;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .header p {
            font-size: 1.2rem;
            opacity: 0.95;
            max-width: 600px;
            margin: 0 auto;
        }

        .header-badges {
            margin-top: 2rem;
        }

        .badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            margin: 0 0.5rem;
            background-color: rgba(255,255,255,0.2);
            border-radius: 50px;
            font-size: 0.9rem;
            backdrop-filter: blur(5px);
        }

        /* Navigation */
        .nav {
            background-color: white;
            border-bottom: 1px solid #e1e4e8;
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav ul {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
        }

        .nav a {
            color: #586069;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav a:hover {
            color: #0366d6;
        }

        /* Main content */
        .content {
            padding: 2rem;
        }

        section {
            margin-bottom: 3rem;
            scroll-margin-top: 70px;
        }

        h2 {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e1e4e8;
            color: #24292e;
        }

        h3 {
            font-size: 1.3rem;
            margin: 1.5rem 0 1rem;
            color: #24292e;
        }

        /* Cards */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin: 1.5rem 0;
        }

        .card {
            background-color: #f6f8fa;
            border: 1px solid #e1e4e8;
            border-radius: 8px;
            padding: 1.5rem;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .card h4 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: #0366d6;
        }

        .card .method {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-right: 0.5rem;
        }

        .method.get { background-color: #61affe; color: white; }
        .method.post { background-color: #49cc90; color: white; }
        .method.put { background-color: #fca130; color: white; }
        .method.delete { background-color: #f93e3e; color: white; }

        /* Tables */
        .table-container {
            overflow-x: auto;
            margin: 1.5rem 0;
            border-radius: 8px;
            border: 1px solid #e1e4e8;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #f6f8fa;
            padding: 0.75rem 1rem;
            text-align: left;
            font-weight: 600;
            border-bottom: 2px solid #e1e4e8;
        }

        td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e1e4e8;
        }

        tr:last-child td {
            border-bottom: none;
        }

        /* Code blocks */
        .code-block {
            background-color: #1e1e1e;
            color: #d4d4d4;
            padding: 1.5rem;
            border-radius: 8px;
            overflow-x: auto;
            margin: 1.5rem 0;
            font-family: 'Fira Code', 'Courier New', monospace;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .code-block .comment { color: #6a9955; }
        .code-block .keyword { color: #569cd6; }
        .code-block .string { color: #ce9178; }
        .code-block .function { color: #dcdcaa; }

        /* JSON examples */
        .json-example {
            background-color: #282c34;
            color: #abb2bf;
            padding: 1.5rem;
            border-radius: 8px;
            overflow-x: auto;
            margin: 1.5rem 0;
            font-family: 'Fira Code', monospace;
            border-left: 4px solid #61afef;
        }

        /* Command line */
        .command-line {
            background-color: #2d2d2d;
            color: #ffffff;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            font-family: 'Fira Code', monospace;
            margin: 1rem 0;
            position: relative;
        }

        .command-line::before {
            content: '$';
            position: absolute;
            left: 0.5rem;
            color: #6a9955;
        }

        /* Info boxes */
        .info-box {
            background-color: #e7f3ff;
            border-left: 4px solid #0366d6;
            padding: 1.5rem;
            border-radius: 4px;
            margin: 1.5rem 0;
        }

        .warning-box {
            background-color: #fff5b1;
            border-left: 4px solid #f9c513;
            padding: 1.5rem;
            border-radius: 4px;
            margin: 1.5rem 0;
        }

        /* Feature grid */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin: 1.5rem 0;
        }

        .feature-item {
            background-color: #f6f8fa;
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
            font-weight: 500;
            border: 1px solid #e1e4e8;
        }

        .feature-item span {
            font-size: 1.5rem;
            display: block;
            margin-bottom: 0.5rem;
        }

        /* Footer */
        .footer {
            background-color: #24292e;
            color: white;
            text-align: center;
            padding: 2rem;
            margin-top: 2rem;
        }

        .footer a {
            color: #79b8ff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Status badges */
        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .status-badge.success { background-color: #28a745; color: white; }
        .status-badge.warning { background-color: #ffc107; color: #24292e; }
        .status-badge.error { background-color: #dc3545; color: white; }
        .status-badge.info { background-color: #17a2b8; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <h1>📋 Task API Controller</h1>
            <p>Un contrôleur RESTful optimisé pour Laravel avec une gestion avancée des erreurs</p>
            <div class="header-badges">
                <span class="badge">Laravel 8+</span>
                <span class="badge">PHP 8+</span>
                <span class="badge">RESTful API</span>
                <span class="badge">JSON Responses</span>
            </div>
        </header>

        <!-- Navigation -->
        <nav class="nav">
            <ul>
                <li><a href="#description">📝 Description</a></li>
                <li><a href="#endpoints">🚀 Endpoints</a></li>
                <li><a href="#responses">📦 Réponses</a></li>
                <li><a href="#installation">🔧 Installation</a></li>
                <li><a href="#validation">📋 Validation</a></li>
                <li><a href="#examples">🎯 Exemples</a></li>
                <li><a href="#errors">🛡️ Gestion d'erreurs</a></li>
                <li><a href="#tests">🧪 Tests</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="content">
            <!-- Description -->
            <section id="description">
                <h2>📝 Description</h2>
                <p>Ce contrôleur Laravel fournit une API RESTful complète pour la gestion des tâches avec :</p>
                
                <div class="features-grid">
                    <div class="feature-item">
                        <span>✅</span>
                        Opérations CRUD
                    </div>
                    <div class="feature-item">
                        <span>🛡️</span>
                        Gestion d'erreurs
                    </div>
                    <div class="feature-item">
                        <span>📊</span>
                        Réponses JSON
                    </div>
                    <div class="feature-item">
                        <span>🔒</span>
                        Validation
                    </div>
                    <div class="feature-item">
                        <span>📝</span>
                        Logging
                    </div>
                    <div class="feature-item">
                        <span>🎯</span>
                        Type safety
                    </div>
                </div>
            </section>

            <!-- Endpoints -->
            <section id="endpoints">
                <h2>🚀 Endpoints</h2>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Méthode</th>
                                <th>URL</th>
                                <th>Description</th>
                                <th>Code HTTP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="method get">GET</span></td>
                                <td><code>/api/tasks</code></td>
                                <td>Récupérer toutes les tâches</td>
                                <td><span class="status-badge success">200</span></td>
                            </tr>
                            <tr>
                                <td><span class="method post">POST</span></td>
                                <td><code>/api/tasks</code></td>
                                <td>Créer une nouvelle tâche</td>
                                <td><span class="status-badge success">201</span></td>
                            </tr>
                            <tr>
                                <td><span class="method get">GET</span></td>
                                <td><code>/api/tasks/{id}</code></td>
                                <td>Récupérer une tâche spécifique</td>
                                <td><span class="status-badge success">200</span></td>
                            </tr>
                            <tr>
                                <td><span class="method put">PUT</span></td>
                                <td><code>/api/tasks/{id}</code></td>
                                <td>Mettre à jour une tâche</td>
                                <td><span class="status-badge success">200</span></td>
                            </tr>
                            <tr>
                                <td><span class="method delete">DELETE</span></td>
                                <td><code>/api/tasks/{id}</code></td>
                                <td>Supprimer une tâche</td>
                                <td><span class="status-badge success">200</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Structure des réponses -->
            <section id="responses">
                <h2>📦 Structure des réponses</h2>
                
                <h3>✅ Succès (200/201)</h3>
                <div class="json-example">
                    {
                        "success": true,
                        "data": {},
                        "message": "Message descriptif"
                    }
                </div>

                <h3>❌ Erreur de validation (422)</h3>
                <div class="json-example">
                    {
                        "success": false,
                        "message": "Erreur de validation",
                        "errors": {
                            "title": ["Le titre est requis"]
                        }
                    }
                </div>

                <h3>🔍 Ressource non trouvée (404)</h3>
                <div class="json-example">
                    {
                        "success": false,
                        "message": "Tâche non trouvée",
                        "error": "Aucune tâche trouvée avec l'ID 999"
                    }
                </div>

                <h3>💥 Erreur serveur (500)</h3>
                <div class="json-example">
                    {
                        "success": false,
                        "message": "Erreur lors de la récupération",
                        "error": "Détails en mode debug / Message générique en prod"
                    }
                </div>
            </section>

            <!-- Installation -->
            <section id="installation">
                <h2>🔧 Installation</h2>
                
                <h3>1. Créer le modèle Task</h3>
                <div class="command-line">
                    php artisan make:model Task -m
                </div>

                <h3>2. Configurer la migration</h3>
                <div class="code-block">
                    <span class="comment">// database/migrations/[timestamp]_create_tasks_table.php</span><br>
                    <span class="keyword">public function</span> <span class="function">up</span>()<br>
                    {<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;Schema::<span class="function">create</span>(<span class="string">'tasks'</span>, <span class="keyword">function</span> (Blueprint $table) {<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$table-><span class="function">id</span>();<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$table-><span class="function">string</span>(<span class="string">'title'</span>);<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$table-><span class="function">text</span>(<span class="string">'description'</span>)-><span class="function">nullable</span>();<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$table-><span class="function">string</span>(<span class="string">'status'</span>)-><span class="function">default</span>(<span class="string">'en_attente'</span>);<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$table-><span class="function">timestamps</span>();<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;});<br>
                    }
                </div>

                <h3>3. Ajouter la route</h3>
                <div class="code-block">
                    <span class="comment">// routes/api.php</span><br>
                    Route::<span class="function">apiResource</span>(<span class="string">'tasks'</span>, TaskController::<span class="keyword">class</span>);
                </div>

                <h3>4. Lancer les migrations</h3>
                <div class="command-line">
                    php artisan migrate
                </div>
            </section>

            <!-- Validation -->
            <section id="validation">
                <h2>📋 Validation des données</h2>
                
                <div class="card-grid">
                    <div class="card">
                        <h4>Création (POST)</h4>
                        <table style="background: transparent;">
                            <tr><td><strong>title</strong></td><td>requis, string, max:255</td></tr>
                            <tr><td><strong>description</strong></td><td>nullable, string</td></tr>
                            <tr><td><strong>status</strong></td><td>nullable, in:en_attente,en_cours,terminee</td></tr>
                        </table>
                    </div>
                    
                    <div class="card">
                        <h4>Mise à jour (PUT)</h4>
                        <p>Mêmes règles mais avec <code>sometimes</code></p>
                    </div>
                </div>

                <div class="info-box">
                    <strong>💡 Statuts disponibles :</strong> en_attente, en_cours, terminee
                </div>
            </section>

            <!-- Exemples d'utilisation -->
            <section id="examples">
                <h2>🎯 Exemples d'utilisation</h2>

                <h3>📌 Créer une tâche</h3>
                <div class="command-line">
                    curl -X POST http://localhost:8000/api/tasks \
                      -H "Content-Type: application/json" \
                      -d '{
                        "title": "Apprendre Laravel",
                        "description": "Suivre le tutoriel sur les API",
                        "status": "en_cours"
                      }'
                </div>

                <h3>📋 Récupérer toutes les tâches</h3>
                <div class="command-line">
                    curl http://localhost:8000/api/tasks
                </div>

                <h3>🔄 Mettre à jour une tâche</h3>
                <div class="command-line">
                    curl -X PUT http://localhost:8000/api/tasks/1 \
                      -H "Content-Type: application/json" \
                      -d '{
                        "status": "terminee"
                      }'
                </div>

                <h3>🗑️ Supprimer une tâche</h3>
                <div class="command-line">
                    curl -X DELETE http://localhost:8000/api/tasks/1
                </div>
            </section>

            <!-- Gestion des erreurs -->
            <section id="errors">
                <h2>🛡️ Gestion des erreurs</h2>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Exception</th>
                                <th>Code HTTP</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><code>ModelNotFoundException</code></td>
                                <td><span class="status-badge error">404</span></td>
                                <td>Ressource non trouvée</td>
                            </tr>
                            <tr>
                                <td><code>ValidationException</code></td>
                                <td><span class="status-badge warning">422</span></td>
                                <td>Données invalides</td>
                            </tr>
                            <tr>
                                <td><code>Throwable</code> (autres)</td>
                                <td><span class="status-badge error">500</span></td>
                                <td>Erreur serveur</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="warning-box">
                    <strong>🔒 Sécurité :</strong> Les détails techniques sont automatiquement masqués en production (APP_DEBUG=false)
                </div>
            </section>

            <!-- Tests -->
            <section id="tests">
                <h2>🧪 Tests unitaires</h2>

                <div class="code-block">
                    <span class="keyword">public function</span> <span class="function">test_can_create_task</span>()<br>
                    {<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;$response = $this-><span class="function">postJson</span>(<span class="string">'/api/tasks'</span>, [<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="string">'title'</span> => <span class="string">'Nouvelle tâche'</span>,<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="string">'status'</span> => <span class="string">'en_attente'</span><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;]);<br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;$response-><span class="function">assertStatus</span>(201)<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-><span class="function">assertJson</span>([<span class="string">'success'</span> => <span class="keyword">true</span>]);<br>
                    }
                </div>

                <div class="command-line">
                    php artisan test --filter=TaskController
                </div>
            </section>

            <!-- Configuration requise -->
            <section>
                <h2>⚙️ Configuration requise</h2>
                <div class="card-grid">
                    <div class="card">
                        <h4>PHP</h4>
                        <p>Version 8.0 ou supérieure</p>
                    </div>
                    <div class="card">
                        <h4>Laravel</h4>
                        <p>Version 8.0 ou supérieure</p>
                    </div>
                    <div class="card">
                        <h4>Base de données</h4>
                        <p>MySQL, PostgreSQL, SQLite</p>
                    </div>
                </div>
            </section>

            <!-- Structure du projet -->
            <section>
                <h2>📁 Structure du projet</h2>
                <div class="code-block">
                    app/<br>
                    ├── Http/<br>
                    │   ├── Controllers/<br>
                    │   │   └── Api/<br>
                    │   │       └── TaskController.php<br>
                    │   └── Requests/<br>
                    │       └── TaskRequest.php (optionnel)<br>
                    ├── Models/<br>
                    │   └── Task.php<br>
                    └── database/<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;└── migrations/<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└── [timestamp]_create_tasks_table.php
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="footer">
            <p>📝 Task API Controller - Documentation complète</p>
            <p>🚀 Prêt à l'emploi avec Laravel</p>
            <p>
                <a href="#">Documentation</a> • 
                <a href="#">Rapporter un bug</a> • 
                <a href="#">Contribuer</a>
            </p>
            <p style="margin-top: 1rem; font-size: 0.9rem; opacity: 0.8;">
                MIT License • 2024
            </p>
        </footer>
    </div>
</body>
</html>
