CREATE DATABASE IF NOT EXISTS webshop;
use webshop;

CREATE TABLE IF NOT EXISTS product (
  id INT AUTO_INCREMENT PRIMARY KEY,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
  `name` VARCHAR(256) NOT NULL,
  `price` DECIMAL(9,2) NOT NULL,
  `release_year` YEAR NOT NULL,
  inventory INT NOT NULL DEFAULT(0),
  deleted INT NOT NULL DEFAULT (0)
);

CREATE TABLE IF NOT EXISTS tag (
  id INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(256) NOT NULL
);

CREATE TABLE IF NOT EXISTS product_with_tag (
  id INT AUTO_INCREMENT PRIMARY KEY,
  product_id INT NOT NULL,
  tag_id INT NOT NULL,
  FOREIGN KEY (product_id) REFERENCES product(id) ON DELETE CASCADE,
  FOREIGN KEY (tag_id) REFERENCES tag(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS product_image (
  id INT AUTO_INCREMENT PRIMARY KEY,
  `name` TEXT NOT NULL,
  product_id INT NOT NULL,
  FOREIGN KEY (product_id) REFERENCES product(id) ON DELETE CASCADE
)

SELECT product.name, product.price, product.release_year AS `Release Year`, tag.name AS `Tag name`
FROM product
INNER JOIN product_with_tag ON product.id = product_with_tag.product_id
INNER JOIN tag ON product_with_tag.tag_id = tag.id;