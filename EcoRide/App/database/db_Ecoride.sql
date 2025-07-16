-- SQL commands for database
use ecoride;

-- Create tables
CREATE TABLE roles(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(255) NOT NULL
);

CREATE TABLE users (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    date_of_birth DATE NOT NULL,
    photo VARCHAR(255),
    credits INT(11),
    id_role INT(11) NOT NULL,
    drivers_license VARCHAR(100) DEFAULT NULL,
    CONSTRAINT fk_user_role
        FOREIGN KEY (id_role) REFERENCES roles(id)
        ON DELETE RESTRICT
);

CREATE TABLE cars(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
);

CREATE TABLE car_sharing(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
);

CREATE TABLE reservations(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
);


CREATE TABLE preferences(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
);

CREATE TABLE feedbacks(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
);


-- Insert data in tables
INSERT INTO roles(name, description) 
VALUES ("admin", "Administrateur du systeme qui peut gerer les comptes et voir les statistiques."),
("employee", "Employe qui peut gerer les trajets et les avis."),
("driver", "Utilisateur enregistre qui peut etre chauffeur d'un trajet"),
("passenger", "Utilisateur enregistre qui peut etre passager d'un trajet." ),
("driverAndpassenger", "Utilisateur enregistre qui peut etre passager ou chauffeur d'un trajet."),
("visitor", "Utilisateur non authentifie, mais il peut tout de meme rechercher des trajets");