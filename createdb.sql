DROP DATABASE IF EXISTS webbsaekerhet;
CREATE DATABASE webbsaekerhet;
USE webbsaekerhet;

CREATE TABLE users
(
    username VARCHAR(512),
    password VARCHAR(512),
    home_address VARCHAR(512),
    PRIMARY KEY (username)
);

CREATE TABLE IF NOT EXISTS products 
(
 id int(10) NOT NULL AUTO_INCREMENT,
 productCode varchar(300) NOT NULL,
 name varchar(300) NOT NULL,
 price double(9,2) NOT NULL,
 img varchar(600) NOT NULL,
 PRIMARY KEY (id)
);

INSERT INTO products (id, productCode, name, price, img) VALUES
(1, 'AIR12' ,'AIR JORDAN 12 RETRO LOW', 170, 'https://cdn.shopify.com/s/files/1/1011/6760/products/Jordan_308317-002-A_large.jpg?v=1489782944'),
(2, 'GANRYFH' ,'GANRYU DEGRADE FLEECE HOODIE', 545,'https://cdn.shopify.com/s/files/1/1011/6760/products/GANRYU_ES-T004-A_large.jpg?v=1491324869');

