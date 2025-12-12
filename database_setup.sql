-- database_setup.sql
-- Run this SQL to create the database and tables

CREATE DATABASE IF NOT EXISTS home_services;
USE home_services;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    gender ENUM('male', 'female') NOT NULL,
    user_type ENUM('customer', 'provider') DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    is_active TINYINT(1) DEFAULT 1
);

-- Create index on email for faster lookups
CREATE INDEX idx_email ON users(email);
CREATE INDEX idx_user_type ON users(user_type);