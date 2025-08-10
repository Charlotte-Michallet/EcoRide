-- SQL commands for database
use ecoride;

-- Create tables
CREATE TABLE roles(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(255) NOT NULL,
    role VARCHAR(255) NOT NULL
);

CREATE TABLE users (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    date_of_birth DATE NOT NULL,
    photo VARCHAR(255),
    credits INT(11),
    id_role INT(11),
    drivers_license BOOLEAN,
    CONSTRAINT fk_user_role
        FOREIGN KEY (id_role) REFERENCES roles(id)
        ON DELETE RESTRICT
);

CREATE TABLE cars(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    brand VARCHAR(50) NOT NULL,
    model VARCHAR(50) NOT NULL,
    energy_type VARCHAR(50) NOT NULL,
    num_seats INT(11) NOT NULL,
    number_plate VARCHAR(30) NOT NULL UNIQUE,
    first_register_date DATE NOT NULL,
    color VARCHAR(50) NOT NULL,
    user_id INT(11) NOT NULL,
    CONSTRAINT fk_user_car
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE preferences(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    user_id INT(11) NOT NULL UNIQUE,
    smoking_allowed BOOLEAN NOT NULL,
    animal_allowed BOOLEAN NOT NULL,
    description TEXT,
    CONSTRAINT fk_user_preference
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE car_sharing(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    car_id INT(11),
    departure_city VARCHAR(255) NOT NULL,
    arrival_city VARCHAR(255) NOT NULL,
    departure_date DATE NOT NULL,
    departure_hour TIME NOT NULL,
    arrival_time TIME NOT NULL,
    price INT(11) NOT NULL,
    num_seats INT(11) NOT NULL,
    CONSTRAINT fk_car_id
    FOREIGN KEY (car_id) REFERENCES cars(id)
);

-- not done

CREATE TABLE feedbacks(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    note FLOAT,
    feedback TEXT,
    status VARCHAR(50),
    reservation_id INT(11),
    CONSTRAINT fk_user_feedback
        FOREIGN KEY (user_id) REFERENCES users(id)
        FOREIGN KEY (reservation_id) REFERENCES roles(id)
);


CREATE TABLE reservations(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
);



-- Insert data in tables
INSERT INTO roles(name, description,role) 
VALUES ("admin", "Administrateur du systeme qui peut gerer les comptes et voir les statistiques.", "Admin"),
("employee", "Employe qui peut gerer les trajets et les avis.", "Employé"),
("driver", "Utilisateur enregistre qui peut etre chauffeur d'un trajet", "Conducteur"),
("passenger", "Utilisateur enregistre qui peut etre passager d'un trajet.", "Passager"),
("driverAndpassenger", "Utilisateur enregistre qui peut etre passager ou chauffeur d'un trajet.", "Conducteur ou passager"),
("visitor", "Utilisateur non authentifie, mais il peut tout de meme rechercher des trajets", "Visiteur");