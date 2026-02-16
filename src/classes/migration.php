<?php

require_once __DIR__ . '/database.php';

class MigrationManager {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Récupère la liste des migrations appliquées
     */
    public function getAppliedMigrations() {
        $stmt = $this->db->prepare("SELECT name FROM migrations ORDER BY applied_at ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * Enregistre une migration comme appliquée
     */
    public function recordMigration($name) {
        try {
            $stmt = $this->db->prepare("INSERT INTO migrations (name) VALUES (:name)");
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Migration error: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Vérifie si une migration a déjà été appliquée
     */
    public function isMigrationApplied($name) {
        $applied = $this->getAppliedMigrations();
        return in_array($name, $applied);
    }

    /**
     * Affiche le statut des migrations
     */
    public function showStatus() {
        $applied = $this->getAppliedMigrations();
        echo "Migrations appliquées: " . count($applied) . "\n";
        foreach ($applied as $migration) {
            echo "  ✓ " . $migration . "\n";
        }
    }
}
?>
