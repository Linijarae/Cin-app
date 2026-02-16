<?php
/**
 * Migration 001: Initialisation de la base de données
 * Crée les tables: migrations, users, movies
 */

return [
    'name' => '001_init_database',
    'up' => function($db) {
        // Table users
        $db->exec("
            CREATE TABLE IF NOT EXISTS users (
                id INT PRIMARY KEY AUTO_INCREMENT,
                login VARCHAR(25) NOT NULL UNIQUE,
                email VARCHAR(100) NOT NULL UNIQUE, 
                password VARCHAR(100) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ");

        // Table movies
        $db->exec("
            CREATE TABLE IF NOT EXISTS movies (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                synopsis TEXT,
                image_url VARCHAR(150),
                release_date DATE
            )
        ");

        // Insertion des données d'exemple
        $db->exec("
            INSERT INTO movies (name, synopsis, image_url, release_date) VALUES 
            ('Inception', 'Dom Cobb est un voleur expérimenté...', 'https://example.com/images/inception.jpg', '2010-07-16'),
            ('Le Parrain', 'L''histoire de la famille Corleone...', '/assets/posters/godfather.png', '1972-03-24')
        ");

        return true;
    },
    'down' => function($db) {
        $db->exec("DROP TABLE IF EXISTS movies");
        $db->exec("DROP TABLE IF EXISTS users");
        return true;
    }
];
?>
