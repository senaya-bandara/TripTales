CREATE DATABASE IF NOT EXISTS wanderlanka
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE wanderlanka;

CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(30) NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE blogPost (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    category VARCHAR(80) NOT NULL DEFAULT 'Travel Stories',
    image VARCHAR(500) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_blog_user
        FOREIGN KEY (user_id) REFERENCES user(id)
        ON DELETE CASCADE
);

CREATE INDEX idx_blog_user ON blogPost(user_id);
CREATE INDEX idx_blog_category ON blogPost(category);

-- Demo content can be added after registering through the website.
