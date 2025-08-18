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

-- You can add more tables later for other features (e.g., users, services, etc.)
