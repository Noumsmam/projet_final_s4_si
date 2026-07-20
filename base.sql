-- Activation du support des clés étrangères (nécessaire sous SQLite)
PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS prefixe;
DROP TABLE IF EXISTS operation;
DROP TABLE IF EXISTS Client;
DROP TABLE IF EXISTS histo_transcaction;
DROP TABLE IF EXISTS offre;
DROP TABLE IF EXISTS frais;
DROP TABLE IF EXISTS offre_frais;

-- 1. Table prefixe
CREATE TABLE IF NOT EXISTS prefixe (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    num TEXT NOT NULL UNIQUE
);

-- 2. Table operation
CREATE TABLE IF NOT EXISTS operation (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    type TEXT NOT NULL
);

-- 3. Table Client
CREATE TABLE IF NOT EXISTS Client (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    id_prefixe INTEGER,
    num TEXT NOT NULL UNIQUE,
    solde REAL DEFAULT 0.0,
    nom TEXT NOT NULL,
    FOREIGN KEY (id_prefixe) REFERENCES prefixe(id) ON DELETE SET NULL
);

-- 4. Table histo_transcaction
CREATE TABLE IF NOT EXISTS histo_transcaction (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    id_client INTEGER NOT NULL,
    montant REAL NOT NULL,
    id_operation INTEGER NOT NULL,
    FOREIGN KEY (id_client) REFERENCES Client(id) ON DELETE CASCADE,
    FOREIGN KEY (id_operation) REFERENCES operation(id) ON DELETE RESTRICT
);

-- 5. Table offre
CREATE TABLE IF NOT EXISTS offre (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    montant_debut REAL NOT NULL,
    montant_fin REAL NOT NULL
);

-- 6. Table frais
CREATE TABLE IF NOT EXISTS frais (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    montant REAL NOT NULL
);

-- 7. Table de association/liaison offre_frais
CREATE TABLE IF NOT EXISTS offre_frais (
    id_offre INTEGER NOT NULL,
    id_frais INTEGER NOT NULL,
    PRIMARY KEY (id_offre, id_frais),
    FOREIGN KEY (id_offre) REFERENCES offre(id) ON DELETE CASCADE,
    FOREIGN KEY (id_frais) REFERENCES frais(id) ON DELETE CASCADE
);

-- Transaction pour garantir l'intégrité des insertions
BEGIN TRANSACTION;

-- 1. Insertion dans la table OFFRE
INSERT INTO offre (montant_debut, montant_fin) VALUES
(100, 1000),
(1001, 5000),
(5001, 10000),
(10001, 25000),
(25001, 50000),
(50001, 100000),
(100001, 250000),
(250001, 500000),
(500001, 1000000),
(1000001, 2000000);

-- 2. Insertion dans la table FRAIS
INSERT INTO frais (montant) VALUES
(50),
(50),
(100),
(200),
(400),
(800),
(1500),
(1500),
(2500),
(3000);

-- 3. Insertion dans la table d'association OFFRE_FRAIS (liaison par ID)
INSERT INTO offre_frais (id_offre, id_frais) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

COMMIT;