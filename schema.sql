DROP DATABASE IF EXISTS  yeticave;
CREATE DATABASE yeticave;
USE yeticave;

CREATE TABLE categories (
id INT AUTO_INCREMENT,
character_code VARCHAR(128) ,
name_category VARCHAR(128),
UNIQUE(character_code),
PRIMARY KEY(id)
);

CREATE TABLE users (

    id INT AUTO_INCREMENT ,
    date_registration DATETIME DEFAULT CURRENT_TIMESTAMP,
    email VARCHAR(128) NOT NULL,
    user_name VARCHAR(128),
    uesr_password CHAR(12),
    contacts TEXT,
    UNIQUE(email),
    PRIMARY KEY(id)
);

CREATE TABLE lots(
     id INT AUTO_INCREMENT,
     date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
     title VARCHAR(255),
     lot_description TEXT,
     img VARCHAR(255),
     start_price INT,
     date_finish  DATETIME,
     step INT,
     user_id INT,
     winner_id INT,
     category_id INT,
     PRIMARY KEY(id),
     FOREIGN KEY (user_id) REFERENCES users(id),
     FOREIGN KEY (winner_id) REFERENCES users(id),
     FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE bets (
    id INT AUTO_INCREMENT,
    date_bet DATETIME DEFAULT CURRENT_TIMESTAMP,
    price_bet INT,
    user_id INT,
    lot_id INT,
    PRIMARY KEY(id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (lot_id) REFERENCES lots(id)
);