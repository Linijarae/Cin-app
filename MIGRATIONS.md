# Migrations - Cin-app

## Structure

```
migrations/
├── 001_init_database.php
└── 002_add_feature.php (futur)
```

## Utilisation

### Voir le statut des migrations
```bash
php migrate.php status
```

### Appliquer les migrations en attente
```bash
php migrate.php up
```

### Revenir la dernière migration
```bash
php migrate.php down
```

### Reset complet (attention !)
```bash
php migrate.php reset
```

## Créer une nouvelle migration

1. Créer un fichier `migrations/002_your_feature_name.php` :

```php
<?php
return [
    'name' => '002_your_feature_name',
    'up' => function($db) {
        // Votre code SQL pour appliquer la migration
        $db->exec("ALTER TABLE users ADD COLUMN phone VARCHAR(20)");
        return true;
    },
    'down' => function($db) {
        // Votre code SQL pour revenir la migration
        $db->exec("ALTER TABLE users DROP COLUMN phone");
        return true;
    }
];
?>
```

2. Exécuter : `php migrate.php up`

## Structure d'une migration

Chaque migration retourne un tableau contenant:
- **name** : Identifiant unique (préfixé par un numéro)
- **up** : Fonction closure qui applique la migration
- **down** : Fonction closure qui revient la migration

Le suivi est automatique via la table `migrations` en BD.
