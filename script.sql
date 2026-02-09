-- CREATION DE LA BASE DE DONNEES

CREATE DATABASE IF NOT EXISTS my_cinema CHARACTER SET utf8mb4;
USE my_cinema;

-- TABLES DES FILMS

CREATE TABLE IF NOT EXISTS movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    duration INT NOT NULL,
    release_year INT NOT NULL,
    genre VARCHAR(255),
    director VARCHAR(100),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- TABLES DES SALLES

CREATE TABLE IF NOT EXISTS rooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    capacity INT NOT NULL,
    type VARCHAR(50),
    -- SOFT DELETE
    active TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;

-- TABLES DES SEANCES (screenings)

CREATE TABLE IF NOT EXISTS screenings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    movies_id INT NOT NULL,
    rooms_id INT NOT NULL,
    screening_time DATETIME NOT NULL,

    -- GESTION DES RELATIONS 

    CONSTRAINT fk_screenings_movie
        FOREIGN KEY (movies_id) REFERENCES movies(id)
        ON DELETE RESTRICT,
    
    CONSTRAINT fk_screenings_room
        FOREIGN KEY (rooms_id) REFERENCES rooms(id)
);