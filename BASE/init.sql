DROP DATABASE IF EXISTS bibliotheque;
CREATE DATABASE IF NOT EXISTS bibliotheque 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE bibliotheque;

CREATE TABLE livres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    auteur VARCHAR(255) NOT NULL,
    isbn VARCHAR(13) UNIQUE NOT NULL,
    annee_publication YEAR,
    categorie VARCHAR(100),
    resume TEXT,
    couverture_filename VARCHAR(255),
    statut ENUM('disponible', 'prêté') DEFAULT 'disponible',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE emprunts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    livre_id INT NOT NULL,
    nom_emprunteur VARCHAR(255) NOT NULL,
    date_emprunt DATE NOT NULL,
    date_retour DATE DEFAULT NULL,
    FOREIGN KEY (livre_id) REFERENCES livres(id) ON DELETE CASCADE
);

CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'lecteur', 'bibliothecaire') DEFAULT 'lecteur'
);

CREATE OR REPLACE VIEW emprunts_livres AS
    SELECT
        e.id AS emprunt_id,
        l.id AS livre_id,
        l.titre AS titre,
        l.auteur AS auteur,
        l.isbn AS isbn,
        e.nom_emprunteur AS nom_emprunteur,
        e.date_emprunt AS date_emprunt,
        e.date_retour AS date_retour
    FROM emprunts e
    INNER JOIN livres l ON e.livre_id = l.id;
