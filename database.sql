CREATE DATABASE IF NOT EXISTS shop_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS shop_db.product (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NULL,
    size INT UNSIGNED NULL
);

INSERT INTO shop_db.product (name, description, size)
VALUES
('Gizmo', 'A thing for a purpose', 32),
('Thingamajig', 'Something useful', 38),
('Widget', 'Thing that does something', 14);