# Cin-app - Documentation Complète

## 📋 Résumé du Projet

Cin-app est une application web PHP permettant aux utilisateurs de :
- Consulter un catalogue de films
- S'inscrire et se connecter
- Réserver des places de cinéma
- Gérer leur profil

## 🏗️ Architecture

### Structure des Fichiers

```
cin-app/
├── public/
│   ├── index.php           # Point d'entrée unique (routeur)
│   └── css/
│       ├── style.css
│       ├── login.css
│       └── register.css
├── src/
│   ├── classes/
│   │   ├── database.php    # Connexion PDO (Singleton)
│   │   └── migration.php   # Gestion des migrations
│   ├── controllers/
│   │   └── authController.php  # Logique authentification
│   ├── models/
│   │   └── cineModel.php   # Modèle films
│   ├── views/              # Templates HTML
│   │   ├── index.php
│   │   ├── home.php
│   │   ├── login.php
│   │   ├── register.php
│   │   ├── profile.php
│   │   ├── reservation.php
│   │   ├── setings.php
│   │   ├── cgu.php
│   │   └── 404.php
│   └── config.php          # Configuration centralisée
├── migrations/
│   └── 001_init_database.php
├── .env                    # Variables d'environnement
├── .gitignore
├── migrate.php             # CLI pour migrations
├── database.sql            # Schéma initial
└── README.md

```

## 🔧 Configuration

### Fichier .env

```env
# Database Configuration
DB_HOST=localhost
DB_NAME=cin_app
DB_USER=root
DB_PASSWORD=

# Server
SERVER_PORT=8000
```

Modifiez les identifiants selon votre environnement.

## 🗄️ Base de Données

### Tables

**users**
- `id` : INT PRIMARY KEY AUTO_INCREMENT
- `login` : VARCHAR(25) UNIQUE NOT NULL
- `email` : VARCHAR(100) UNIQUE NOT NULL
- `password` : VARCHAR(100) NOT NULL (hashé avec bcrypt)
- `created_at` : TIMESTAMP DEFAULT CURRENT_TIMESTAMP

**movies**
- `id` : INT AUTO_INCREMENT PRIMARY KEY
- `name` : VARCHAR(100) NOT NULL
- `synopsis` : TEXT
- `image_url` : VARCHAR(150)
- `release_date` : DATE

**migrations**
- `id` : INT PRIMARY KEY AUTO_INCREMENT
- `name` : VARCHAR(255) UNIQUE NOT NULL
- `applied_at` : TIMESTAMP DEFAULT CURRENT_TIMESTAMP

### Initialisation

```bash
# Créer la BD et importer le schéma
mysql -u root cin_app < database.sql

# OU exécuter les migrations
php migrate.php up
```

## 🚀 Démarrage

### Lancer le serveur PHP

```bash
cd public
php -S localhost:8000
```

Accédez à `http://localhost:8000`

### Redirection Automatique

- `/` → redirige vers `/home`
- `/home` affiche la liste des films

## 🔐 Authentification

### Inscription

1. Aller sur `/register`
2. Remplir le formulaire (nom, email, mot de passe)
3. Validation :
   - Email unique
   - Mot de passe ≥ 6 caractères
   - Confirmations doivent correspondre
4. Le hash bcrypt est appliqué automatiquement

### Connexion

1. Aller sur `/login`
2. Entrer email + mot de passe
3. Vérification contre BD avec `password_verify()`
4. Session créée : `$_SESSION['user_id']` et `$_SESSION['login']`

### Déconnexion

Clic sur `/logout` détruit la session et redirige vers `/login`

## 📌 Routes

| Route | Méthode | Description |
|-------|---------|-------------|
| `/` | GET | Redirection → `/home` |
| `/home` | GET | Affiche films |
| `/index` | GET | Page d'accueil |
| `/login` | GET/POST | Authentification |
| `/register` | GET/POST | Inscription |
| `/profile` | GET | Profil utilisateur |
| `/reservation` | GET | Réservation |
| `/setings` | GET | Paramètres |
| `/cgu` | GET | Conditions générales |
| `/logout` | GET | Déconnexion |
| `/404` | GET | Page non trouvée |

## 🛠️ Classes

### Database (Singleton)

```php
$db = Database::getInstance()->getConnection();
```

- Lit config depuis `.env`
- Retourne connexion PDO configurée
- Charset UTF-8MB4

### MoviesModel

```php
$model = new MoviesModel();
$movies = $model->getAllMovies();      // Tous les films
$movie = $model->getMovie($id);        // Film par ID
```

### AuthController

```php
$auth = new AuthController();
$auth->login($email, $password);   // Retourne ['success' => bool, 'message' => string]
$auth->register($name, $email, $password, $confirm_password);
$auth->logout();
```

## 📊 Migrations

### Voir le statut

```bash
php migrate.php status
```

### Appliquer les migrations

```bash
php migrate.php up
```

### Revenir une migration

```bash
php migrate.php down
```

### Reset complet

```bash
php migrate.php reset
```

### Créer une nouvelle migration

1. Créer `migrations/002_your_name.php` :

```php
<?php
return [
    'name' => '002_your_name',
    'up' => function($db) {
        $db->exec("ALTER TABLE users ADD COLUMN phone VARCHAR(20)");
        return true;
    },
    'down' => function($db) {
        $db->exec("ALTER TABLE users DROP COLUMN phone");
        return true;
    }
];
?>
```

2. Exécuter : `php migrate.php up`

## 🔒 Sécurité

- ✅ Mots de passe hashés avec bcrypt
- ✅ Prepared statements (PDO) contre injection SQL
- ✅ Échappement HTML avec `htmlspecialchars()`
- ✅ Sessions pour authentification
- ✅ Redirection POST → GET après inscription
- ⚠️ TODO : Ajouter CSRF tokens
- ⚠️ TODO : Ajouter rate limiting
- ⚠️ TODO : Valider email via lien de confirmation

## 📝 Notes de Développement

### Fichiers Gelés

- `authController.php` : Classe métier, à appeler depuis `public/index.php`
- `database.php` : Singleton, toujours utiliser via `getInstance()`
- `cineModel.php` : Modèle films, peut être étendu

### À Faire

- [ ] Panier/paiement
- [ ] Récupération mot de passe
- [ ] Confirmation email
- [ ] Historique réservations
- [ ] Admin panel
- [ ] Tests unitaires
- [ ] API REST
- [ ] Docker compose

## 🤝 Contributeurs

- **ZdarkBlackShadow** ([GitHub](https://github.com/ZdarkBlackShadow))
- **Linijarae** ([GitHub](https://github.com/Linijarae))
- **Graphist**: Gemini

## 📄 License

CC0 - Utilisation libre

---

**Dernière mise à jour**: 16 Février 2026   
**Version**: 1.0.0
