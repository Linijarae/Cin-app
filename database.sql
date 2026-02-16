CREATE DATABASE IF NOT EXISTS cin_app;
USE cin_app;

-- Table de suivi des migrations
CREATE TABLE IF NOT EXISTS migrations (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    login VARCHAR(25) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE, 
    password VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    synopsis TEXT,
    image_url VARCHAR(150),
    release_date DATE
);

-- Enregistrement de la migration initiale
INSERT INTO migrations (name) VALUES ('001_init_database');

-- Valeurs d'exemple :

INSERT INTO movies (name, synopsis, image_url, release_date) VALUES 
('Inception', 'Dom Cobb est un voleur expérimenté...', 'https://example.com/images/inception.jpg', '2010-07-16'),
('Le Parrain', 'L''histoire de la famille Corleone...', '/assets/posters/godfather.png', '1972-03-24');