#!/usr/bin/env php
<?php
/**
 * Script de gestion des migrations
 * Usage: php migrate.php [status|up|down|reset]
 */

require_once __DIR__ . '/src/classes/database.php';
require_once __DIR__ . '/src/classes/migration.php';

$command = $argv[1] ?? 'status';

$migrationManager = new MigrationManager();
$db = Database::getInstance()->getConnection();

// Dossier contenant les migrations
$migrationsDir = __DIR__ . '/migrations';

switch ($command) {
    case 'status':
        echo "\n=== Statut des migrations ===\n";
        $migrationManager->showStatus();
        break;

    case 'up':
        echo "\n=== Exécution des migrations ===\n";
        $files = scandir($migrationsDir);
        sort($files);

        foreach ($files as $file) {
            if (strpos($file, '.php') === false) continue;

            $migration = require $migrationsDir . '/' . $file;

            if (!$migrationManager->isMigrationApplied($migration['name'])) {
                echo "Exécution: " . $migration['name'] . "... ";
                try {
                    if ($migration['up']($db)) {
                        $migrationManager->recordMigration($migration['name']);
                        echo "✓\n";
                    }
                } catch (Exception $e) {
                    echo "✗ Erreur: " . $e->getMessage() . "\n";
                }
            }
        }
        echo "Terminé.\n";
        break;

    case 'down':
        echo "\n=== Rollback des migrations ===\n";
        $applied = $migrationManager->getAppliedMigrations();
        
        if (empty($applied)) {
            echo "Aucune migration à revenir.\n";
            break;
        }

        // Revenir la dernière migration
        $lastMigration = end($applied);
        $file = str_replace('_', '_', $lastMigration) . '.php';
        $migrationFile = $migrationsDir . '/' . $file;

        if (file_exists($migrationFile)) {
            $migration = require $migrationFile;
            echo "Rollback: " . $migration['name'] . "... ";
            try {
                if ($migration['down']($db)) {
                    // Supprimer l'enregistrement
                    $stmt = $db->prepare("DELETE FROM migrations WHERE name = :name");
                    $stmt->bindValue(':name', $migration['name']);
                    $stmt->execute();
                    echo "✓\n";
                }
            } catch (Exception $e) {
                echo "✗ Erreur: " . $e->getMessage() . "\n";
            }
        }
        break;

    case 'reset':
        echo "\n=== Reset complet ===\n";
        try {
            $db->exec("DROP TABLE IF EXISTS migrations");
            $db->exec("DROP TABLE IF EXISTS movies");
            $db->exec("DROP TABLE IF EXISTS users");
            echo "Tables supprimées.\n";
            
            // Réappliquer les migrations
            $_SERVER['argv'] = ['migrate.php', 'up'];
            require __FILE__;
        } catch (Exception $e) {
            echo "Erreur: " . $e->getMessage() . "\n";
        }
        break;

    default:
        echo "Usage: php migrate.php [status|up|down|reset]\n";
        break;
}
?>
