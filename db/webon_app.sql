CREATE DATABASE webon_app;

USE webon_app;

CREATE TABLE featured_projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    subtitle VARCHAR(255),
    image VARCHAR(255),
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image VARCHAR(255),
    status ENUM('draft','published') DEFAULT 'draft',
    views INT DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    author_id INT
);

CREATE TABLE contact_messages (
            id INT AUTO_INCREMENT PRIMARY KEY,
            fname VARCHAR(100),
            email VARCHAR(100),
            phone VARCHAR(50),
            website VARCHAR(100),
            message TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );
-- You can add more tables later for other features (e.g., users, services, etc.)
