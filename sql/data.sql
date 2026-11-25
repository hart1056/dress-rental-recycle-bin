-- ============================================
-- Dress Rental System - Database Schema
-- ============================================

CREATE TABLE users (
    user_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    address VARCHAR(255) NOT NULL,
    age INT(11) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE customers (
    customer_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    contact_number VARCHAR(20) NOT NULL,
    date_added TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    added_by INT(11) NULL,
    last_updated_by INT(11) NULL,
    last_updated DATETIME NULL
);

CREATE TABLE rental_records (
    rental_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    customer_id INT(11) NOT NULL,
    dress_name VARCHAR(100) NOT NULL,
    rental_date DATE NOT NULL,
    return_date DATE NOT NULL,
    date_added TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    rental_fee DECIMAL(10,2) NOT NULL,
    status VARCHAR(30) NULL DEFAULT 'Rented',
    added_by INT(11) NULL,
    last_updated_by INT(11) NULL,
    last_updated DATETIME NULL,
    INDEX (customer_id)
);

CREATE TABLE customer_deletion_logs (
    log_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    customer_id INT(11) NOT NULL,
    customer_name VARCHAR(100) NOT NULL,
    contact_number VARCHAR(20) NOT NULL,
    deleted_by INT(11) NOT NULL,
    deleted_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE rental_deletion_logs (
    log_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    rental_id INT(11) NOT NULL,
    customer_id INT(11) NOT NULL,
    dress_name VARCHAR(100) NOT NULL,
    deleted_by INT(11) NOT NULL,
    deleted_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);
