-- SQLBook: Code
DROP DATABASE IF EXISTS escape_game;

CREATE DATABASE escape_game;

USE escape_game;

CREATE TABLE enigma (
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(100),
    description VARCHAR (255),
    hint VARCHAR (255),
    answer VARCHAR (255),
    PRIMARY KEY (id)
);

INSERT INTO enigma (title, description, hint, answer)
VALUES ('Tableau électrique', 'Quel fil faut-il reconnecter pour allumer la lumière de sécurité ?', 'Regarde sur le volet du tableau électrique', 'Les fils rouges'),
('Post-it du tableau en liège', 'Tiens, qu\'y a-t-il sur ce post-it ?', 'Clique sur le post-it du tableau en liège.', ''),
('Armoire de droite', 'Cette armoire est fermée avec un cadenas !', 'Il y en a plein à la Wild', 'Ordinateur'),
('Ordinateur', 'Il est verrouillé par un mot de passe', 'Le mot de passe est la réponse de l\'armoire de droite', 'Ordinateur'),
('Armoire de gauche', 'Elle est verrouillée par un cadenas !', 'Le code est sur l\'ordinateur', '5426'),
('La porte de sortie', 'Elle est fermée à clé !', 'Trouve la clé qui se trouve dans une armoire', '');

CREATE TABLE object (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR (50) NOT NULL,
    description VARCHAR (255),
    PRIMARY KEY (id)
);


CREATE TABLE user (
    id INT NOT NULL AUTO_INCREMENT,
    pseudo VARCHAR(50),
    password VARCHAR(255),
    email VARCHAR(255) NOT NULL, 
    PRIMARY KEY (id)
);

CREATE TABLE progress (
    id INT NOT NULL AUTO_INCREMENT,
    success TINYINT,
    score INT,
    PRIMARY KEY (id)
);

CREATE TABLE session (
id INT NOT NULL AUTO_INCREMENT,
user_id INT,
name VARCHAR(255),
PRIMARY KEY (id),
FOREIGN KEY (user_id) REFERENCES user(id)
);

CREATE TABLE inventory (
    id INT NOT NULL AUTO_INCREMENT,
    object_id INT,
    session_id INT,
    PRIMARY KEY (id),
    FOREIGN KEY (object_id) REFERENCES object(id),
    FOREIGN KEY (session_id) REFERENCES session(id)
);

CREATE TABLE scenario (
id INT NOT NULL AUTO_INCREMENT,
name VARCHAR(255),
enigma_id INT,
session_id INT,
progress_id INT,
PRIMARY KEY (id),
FOREIGN KEY (session_id) REFERENCES session(id),
FOREIGN KEY (enigma_id) REFERENCES enigma(id),
FOREIGN KEY (progress_id) REFERENCES progress(id)
);
