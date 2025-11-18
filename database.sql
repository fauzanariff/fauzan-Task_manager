CREATE DATABASE IF NOT EXISTS task_manager;
USE task_manager;

-- TABEL USERS
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    token VARCHAR(255) NULL,
    token_expire DATETIME NULL,
    status ENUM('PENDING','ACTIVE') DEFAULT 'PENDING',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- TABEL TASKS
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    title VARCHAR(255),
    description TEXT,
    status ENUM('To-Do','In-Progress','Done') DEFAULT 'To-Do',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
