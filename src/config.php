<?php
/**
 * Configuration centralisée de l'application
 * Point d'entrée unique pour les includes et la logique globale
 */

// Démarre la session
session_start();

// Charge la classe Database
require_once __DIR__ . '/src/classes/database.php';
require_once __DIR__ . '/src/classes/migration.php';
require_once __DIR__ . '/src/models/cineModel.php';

// Configuration de base
define('APP_NAME', 'Cin-app');
define('APP_VERSION', '1.0.0');
define('APP_ROOT', dirname(__FILE__));

// Fonction utilitaire pour les redirections sécurisées
function redirect($url) {
    header('Location: ' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8'));
    exit;
}

// Fonction pour échapper les sorties HTML
function escape($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Gestion des erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
