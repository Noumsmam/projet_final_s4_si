-- Version SQLite (équivalent de init.sql + donnees.sql)
-- SQLite utilise un fichier de base de données unique (ex. : bibliotheque.db)

PRAGMA foreign_keys = ON;

-- Suppression des objets existants (ordre inverse des dépendances)
DROP VIEW IF EXISTS emprunts_livres;
DROP TABLE IF EXISTS emprunts;
DROP TABLE IF EXISTS utilisateurs;
DROP TABLE IF EXISTS livres;

CREATE TABLE livres (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    titre TEXT NOT NULL,
    auteur TEXT NOT NULL,
    isbn TEXT UNIQUE NOT NULL,
    annee_publication INTEGER,
    categorie TEXT,
    resume TEXT,
    couverture_filename TEXT,
    statut TEXT DEFAULT 'disponible' CHECK (statut IN ('disponible', 'prêté')),
    created_at TEXT DEFAULT (datetime('now')),
    updated_at TEXT DEFAULT (datetime('now'))
);

CREATE TABLE emprunts (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    livre_id INTEGER NOT NULL,
    nom_emprunteur TEXT NOT NULL,
    date_emprunt TEXT NOT NULL,
    date_retour TEXT DEFAULT NULL,
    FOREIGN KEY (livre_id) REFERENCES livres(id) ON DELETE CASCADE
);

CREATE TABLE utilisateurs (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    role TEXT DEFAULT 'lecteur' CHECK (role IN ('admin', 'lecteur', 'bibliothecaire'))
);

-- Mise à jour automatique de updated_at (équivalent de ON UPDATE CURRENT_TIMESTAMP)
CREATE TRIGGER trg_livres_updated_at
AFTER UPDATE ON livres
FOR EACH ROW
WHEN NEW.updated_at = OLD.updated_at
BEGIN
    UPDATE livres SET updated_at = datetime('now') WHERE id = OLD.id;
END;

CREATE VIEW emprunts_livres AS
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

-- Données de test pour la table `livres`
INSERT INTO livres (titre, auteur, isbn, annee_publication, categorie, resume, couverture_filename, statut) VALUES
('Le Petit Prince', 'Antoine de Saint-Exupéry', '9782070612758', 1943, 'Jeunesse', 'Un pilote tombe dans le désert et rencontre un jeune prince venu d''une autre planète.', 'petit_prince.jpg', 'disponible'),
('1984', 'George Orwell', '9780451524935', 1949, 'Dystopie', 'L''histoire de Winston Smith dans un monde sous surveillance constante par Big Brother.', '1984_cover.png', 'prêté'),
('Fondation', 'Isaac Asimov', '9782070463633', 1951, 'Science-Fiction', 'L''effondrement d''un empire galactique et la création d''une fondation pour sauver le savoir.', 'fondation.jpg', 'disponible'),
('L''Étranger', 'Albert Camus', '9782070360024', 1942, 'Philosophie', 'Meursault, un homme qui semble indifférent au monde, commet un meurtre sans raison apparente.', 'etranger.jpg', 'prêté'),
('Dune', 'Frank Herbert', '9782221002872', 1965, 'Science-Fiction', 'La lutte pour le contrôle de la planète Arrakis, seule source de l''Épice.', 'dune_v1.webp', 'disponible');

INSERT INTO emprunts (livre_id, nom_emprunteur, date_emprunt, date_retour) VALUES
(1, 'Alice Martin', '2023-10-01', '2023-10-15'), -- Emprunt terminé (Le Petit Prince)
(2, 'Jean Dupont', '2023-11-05', NULL),         -- Emprunt en cours (1984)
(4, 'Sophie Bernard', '2023-11-10', NULL),      -- Emprunt en cours (L'Étranger)
(3, 'Marc Lefebvre', '2023-09-20', '2023-10-05'); -- Emprunt terminé (Fondation)

-- Données de test pour la table `utilisateurs`
INSERT INTO utilisateurs (nom, email, role, password) VALUES
('Admin Test', 'admin@example.com', 'admin', 'adminpass'),
('Claire Dubois', 'claire.dubois@example.com', 'bibliothecaire', 'password1'),
('Lucas Martin', 'lucas.martin@example.com', 'lecteur', 'password2'),
('Sofia Renaud', 'sofia.renaud@example.com', 'lecteur', 'password3'),
('Pierre Laurent', 'pierre.laurent@example.com', 'bibliothecaire', 'password4');
