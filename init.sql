CREATE DATABASE IF NOT EXISTS webshop;
use webshop;

CREATE TABLE IF NOT EXISTS product (
  id INT AUTO_INCREMENT PRIMARY KEY,
  uuid VARCHAR(36) DEFAULT(UUID()),
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
  `name` VARCHAR(256) NOT NULL DEFAULT 'placeholder',
  product_id INT NOT NULL,
  FOREIGN KEY (product_id) REFERENCES product(id) ON DELETE CASCADE
);

-- Insert Tags
INSERT INTO tag (`name`) VALUES 
  ('Tech'), 
  ('Clothing'), 
  ('Giftcards'), 
  ('Service');

  -- Insert Products
INSERT INTO product (`name`, `price`, `release_year`, `inventory`) VALUES
  ('Laptop X200', 899.99, 2024, 50),
  ('Smartphone Z3', 499.99, 2023, 100),
  ('Wireless Headphones', 129.99, 2024, 200),
  ('T-Shirt - Logo', 19.99, 2023, 150),
  ('Giftcard $50', 50.00, 2025, 500),
  ('Basic Web Hosting Service', 9.99, 2025, 300);

-- Insert Product with Tags
INSERT INTO product_with_tag (product_id, tag_id) VALUES
  (1, 1),  -- Laptop X200 - Tech
  (2, 1),  -- Smartphone Z3 - Tech
  (3, 1),  -- Wireless Headphones - Tech
  (4, 2),  -- T-Shirt - Logo - Clothing
  (5, 3),  -- Giftcard $50 - Giftcards
  (6, 4);  -- Basic Web Hosting Service - Service

-- Insert Product Images (using placeholder.png)
INSERT INTO product_image (`name`, product_id) VALUES
  ('placeholder.png', 1),  -- Laptop X200
  ('placeholder.png', 2),  -- Smartphone Z3
  ('placeholder.png', 3),  -- Wireless Headphones
  ('placeholder.png', 4),  -- T-Shirt - Logo
  ('placeholder.png', 5),  -- Giftcard $50
  ('placeholder.png', 6);  -- Basic Web Hosting Service
