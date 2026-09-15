-- =====================================
-- FOOD DELIVERY SYSTEM DATABASE
-- =====================================
CREATE DATABASE IF NOT EXISTS food_delivery;
USE food_delivery;
-- =========================
-- USERS TABLE
-- =========================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- =========================
-- FOODS TABLE
-- =========================
CREATE TABLE foods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- =========================
-- ORDERS TABLE
-- =========================
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    total INT,
    status VARCHAR(50) DEFAULT 'Pending',
    created_at DATETIME
);
-- =========================
-- ORDER ITEMS TABLE
-- =========================
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    food_name VARCHAR(100),
    price INT,
    qty INT
);
-- =========================
-- SAMPLE ADMIN USER
-- =========================
INSERT INTO users (username, email, password, role)
VALUES ('admin', 'admin@gmail.com', '1234', 'admin');
-- =========================
-- SAMPLE FOODS
-- =========================
INSERT INTO foods (name, price) VALUES
('Burger', 10000),
('Pizza', 15000),
('Chicken', 12000),
('Chips', 5000);