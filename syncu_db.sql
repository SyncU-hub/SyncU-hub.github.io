CREATE DATABASE syncu_db;
GO

USE syncu_db;
GO

CREATE TABLE users (
    user_id INT IDENTITY(1,1) PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    birthdate DATE NOT NULL
);
GO

CREATE TABLE profiles (
    user_id INT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    student_type VARCHAR(50) NOT NULL,
    university VARCHAR(255) NOT NULL,
    career VARCHAR(255) NOT NULL,
    career_year VARCHAR(50) NOT NULL,
    country_origin VARCHAR(100) NOT NULL,
    languages VARCHAR(255) NOT NULL,
    about_me TEXT NULL,
    profile_pic VARCHAR(255) NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE
);
GO

CREATE TABLE social_links (
    user_id INT PRIMARY KEY,
    instagram VARCHAR(100) NULL,
    tiktok VARCHAR(100) NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE
);
GO

-- Índices
CREATE INDEX idx_fullname ON profiles(full_name);
CREATE INDEX idx_university ON profiles(university);