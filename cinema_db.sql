CREATE DATABASE IF NOT EXISTS cinema_db;
USE cinema_db;

-- USERS (same as yours, unchanged)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    emri VARCHAR(50) NOT NULL,
    mbiemri VARCHAR(50) NOT NULL,
    adresa VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    tel VARCHAR(20) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user','admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- MOVIES
CREATE TABLE IF NOT EXISTS movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    image_path VARCHAR(255),
    price DECIMAL(6,2) NOT NULL
);

-- 🎬 MOVIE SHOWTIMES (NEW)
CREATE TABLE IF NOT EXISTS showtimes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    movie_id INT NOT NULL,
    show_time TIME NOT NULL,

    FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE
);

-- 🎟️ TICKETS (IMPROVED)
CREATE TABLE IF NOT EXISTS tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    movie_id INT NOT NULL,
    showtime_id INT NOT NULL,
    ticket_name VARCHAR(100) NOT NULL, -- UNIQUE NAME
    quantity INT NOT NULL,
    total_price DECIMAL(7,2) NOT NULL,
    purchased_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (movie_id) REFERENCES movies(id),
    FOREIGN KEY (showtime_id) REFERENCES showtimes(id)
);
