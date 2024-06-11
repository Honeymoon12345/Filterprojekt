CREATE TABLE produkte
(
    id INT AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    order_id INT,
    description VARCHAR(1000) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE user
(
    id INT AUTO_INCREMENT,
    is_admin TINYINT(1) NOT NULL,
    firstname VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    email VARCHAR(320) NOT NULL,
    password VARCHAR(100) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (email)
);

CREATE TABLE bestellungen
(
    id INT AUTO_INCREMENT,
    order_date DATETIME NOT NULL,
    order_value DECIMAL(10,2) NOT NULL,
    user_id INT,
    PRIMARY KEY (id)
);