-- On nettoie (au cas où) et on force l'UTF-8
DROP DATABASE IF EXISTS cin_app;
CREATE DATABASE cin_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE cin_app;

-- Table migrations
CREATE TABLE migrations (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table users
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    login VARCHAR(25) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE, 
    password VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table movies
CREATE TABLE movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    synopsis TEXT,
    image_url VARCHAR(150),
    release_date DATE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table reservations
CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    movie_id INT NOT NULL,
    number_of_seats INT NOT NULL DEFAULT 1,
    total_price DECIMAL(10, 2),
    screening_date DATETIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    CONSTRAINT fk_reservations_user 
        FOREIGN KEY (user_id) 
        REFERENCES users(id) 
        ON DELETE CASCADE,
        
    CONSTRAINT fk_reservations_movie
        FOREIGN KEY (movie_id) 
        REFERENCES movies(id) 
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO migrations (name) VALUES ('001_init_database');

INSERT INTO movies (name, synopsis, image_url, release_date) VALUES 
('Purple Shadows', 'Liam Blackwood and Dr. Chloe Zhang unite to merge offensive and defensive strategies, creating the ultimate purple team to secure the digital realm against a quantum threat.', 'img/image1.png', '2026-10-26'),
('Blue Shield', 'In a world of constant cyber warfare, the Blue Shield stands as a digital fortress. A dedicated team of defenders protects the city''s infrastructure from the encroaching darkness.', 'img/image2.png', '2026-11-15'),
('Red Team: Zero Trust', 'Attack is the only defense. A team of elite hackers infiltrates a high-security facility to expose vulnerabilities in a zero-trust environment before the enemy does.', 'img/image3.png', '2042-05-20'),
('Neon Genesis: Cyber City', 'In 2099, within a futuristic megalopolis, Kael, a genius hacker, uncovers a conspiracy to control the population via cybernetic implants. She must ally with a renegade cop to trigger a revolution.', 'img/image4.png', '2099-01-01'),
('The House of Tears', 'A young woman inherits an isolated manor in the English countryside. While renovating it, she and her boyfriend witness terrifying phenomena caused by the tormented spirits of former occupants.', 'img/image5.png', '2023-10-31'),
('Sword Dawn', 'In a fantasy kingdom threatened by darkness, Elian, a young knight, is chosen by an ancient prophecy to wield the Sword of Dawn, a legendary weapon capable of defeating the Lord of Shadows.', 'img/image6.png', '2024-12-25'),
('Two Hearts on a Stroll', 'During a business trip to Paris, Thomas, a cynical architect, meets Chloe, a bohemian street artist. Despite their differences, they spend a magical day exploring the City of Light together.', 'img/image7.png', '2025-02-14'),
('Treasure Of The Lost Empire', 'Intrepid explorer Jack Wilde searches for a legendary treasure hidden in the Amazon jungle ruins. Pursued by mercenaries, he discovers the treasure is protected by an ancient guardian.', 'img/image8.png', '2024-07-10'),
('Shadow of The Nights', 'In 1940s New York, a disillusioned private detective is hired by a mysterious femme fatale to investigate a blackmail case that plunges him into the heart of a deadly criminal conspiracy.', 'img/image9.png', '1945-09-15');
