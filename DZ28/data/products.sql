DROP DATABASE IF EXISTS newshop;
CREATE DATABASE newshop;
USE newshop;

DROP TABLE IF EXISTS catalogs;
CREATE TABLE catalogs(
	id SERIAL PRIMARY KEY,
    name VARCHAR(100)
    
  );
    
INSERT INTO catalogs VALUES(NULL, 'Food'),(NULL, 'Office'),(NULL, 'Dress');



DROP TABLE IF EXISTS products;
CREATE TABLE products(
	id SERIAL PRIMARY KEY,
    name VARCHAR(100),
    description VARCHAR(255),
    price INT,
    catalog_id BIGINT UNSIGNED,
   
    
    FOREIGN KEY (catalog_id) REFERENCES catalogs(id) ON UPDATE CASCADE ON DELETE SET NULL);
    
INSERT INTO products VALUES(NULL, 'Tea', 'Ceylon',20, 1),(NULL, 'Pizza', 'Margarita',50, 1),(NULL, 'Pen', 'Black roller pen',15, 2);
INSERT INTO products VALUES(NULL, 'TeaGreen', 'China',20,1), (NULL, 'Dress', 'Ivanovo',200, 3),(NULL, 'Skirt', 'France',5000, 3),(NULL, 'Banana', 'Ecuador',10, 1),(NULL, 'potatoes', 'Belarus',100, 1);

DROP TABLE IF EXISTS users;
CREATE TABLE users(
	id SERIAL PRIMARY KEY,
    name  VARCHAR(100) UNIQUE,
    pass VARCHAR(100),
    hash VARCHAR(100),
    currentBasket VARCHAR(100)
    );
INSERT INTO users VALUES(NULL, 'admin', '$2y$10$R2DhfzOm18.RIsilYrNUFOtXw7d4DzICYJ/bThqNAOmenLh8MZb/e',NULL,'1234567890');

DROP TABLE IF EXISTS basket;
CREATE TABLE basket(
	id SERIAL PRIMARY KEY,
    user_id BIGINT UNSIGNED,
    product_id BIGINT UNSIGNED,
     currentBasket VARCHAR(100),
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE SET NULL,
    FOREIGN KEY (product_id) REFERENCES products(id) ON UPDATE CASCADE ON DELETE CASCADE,
    KEY (currentBasket)    
    );
    

DROP TABLE IF EXISTS orders;
CREATE TABLE orders(
	id SERIAL PRIMARY KEY,
    user_id BIGINT UNSIGNED,
    tel VARCHAR(10),
    sum BIGINT UNSIGNED,
     currentBasket VARCHAR(100),
     statusOrder ENUM('new', 'paid', 'close'),
    
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE SET NULL
    
    );
    
    
