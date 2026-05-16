CREATE DATABASE IF NOT EXISTS webdev_agency;

USE webdev_agency;

CREATE TABLE users (

    user_id INT AUTO_INCREMENT PRIMARY KEY,

    username VARCHAR(100) UNIQUE NOT NULL,

    password VARCHAR(255) NOT NULL

);

CREATE TABLE developers (

    developer_id INT AUTO_INCREMENT PRIMARY KEY,

    developer_name VARCHAR(100) NOT NULL,

    specialty VARCHAR(100) NOT NULL

);

CREATE TABLE projects (

    project_id INT AUTO_INCREMENT PRIMARY KEY,

    developer_id INT,

    project_name VARCHAR(100) NOT NULL,

    client_name VARCHAR(100) NOT NULL,

    FOREIGN KEY (developer_id)
    REFERENCES developers(developer_id)
    ON DELETE CASCADE

);

CREATE TABLE activity_logs (

    log_id INT AUTO_INCREMENT PRIMARY KEY,

    username VARCHAR(100),

    action TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);