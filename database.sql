-- On supprime l'ancienne base pour repartir propre (ATTENTION : supprime les données existantes)
DROP DATABASE IF EXISTS cin_app;

-- On recrée avec le bon encodage
CREATE DATABASE cin_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE cin_app;

CREATE TABLE migrations (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    login VARCHAR(25) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE, 
    password VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    synopsis TEXT,
    image_url VARCHAR(150),
    release_date DATE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO migrations (name) VALUES ('001_init_database');

-- Tes données seront maintenant bien interprétées
INSERT INTO movies (name, synopsis, image_url, release_date) VALUES 
('Inception', 'Dom Cobb est un voleur expérimenté...', 'https://example.com/images/inception.jpg', '2010-07-16'),
('Le Parrain', 'L''histoire de la famille Corleone...', '/assets/posters/godfather.png', '1972-03-24');