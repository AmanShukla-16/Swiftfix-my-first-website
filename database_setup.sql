-- Create database if not exists
CREATE DATABASE IF NOT EXISTS service;

-- Use the database
USE service;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create plumbers table
CREATE TABLE IF NOT EXISTS plumbers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    contact VARCHAR(20) NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create cleaners table
CREATE TABLE IF NOT EXISTS cleaners (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    contact VARCHAR(20) NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create electricians table
CREATE TABLE IF NOT EXISTS electricians (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    contact VARCHAR(20) NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create login_activity table
CREATE TABLE IF NOT EXISTS login_activity (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    type ENUM('admin', 'public') NOT NULL,
    time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert some sample data
INSERT INTO users (username, email) VALUES
('user1', 'user1@example.com'),
('user2', 'user2@example.com'),
('user3', 'user3@example.com');

INSERT INTO plumbers (name, contact) VALUES
('Plumber1', '123-456-7890'),
('Plumber2', '098-765-4321');

INSERT INTO cleaners (name, contact) VALUES
('Cleaner1', '111-222-3333'),
('Cleaner2', '444-555-6666');

INSERT INTO electricians (name, contact) VALUES
('Electrician1', '777-888-9999'),
('Electrician2', '000-111-2222');

INSERT INTO login_activity (username, type) VALUES
('user1', 'public'),
('admin', 'admin'),
('user2', 'public');
