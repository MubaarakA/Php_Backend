-- ISP Hotspot Billing - Application Tables
-- Run against the existing FreeRADIUS MySQL database (radius).
-- Do NOT create a custom users table. Users live in radcheck/radreply.

CREATE TABLE IF NOT EXISTS routers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    router VARCHAR(50) NOT NULL UNIQUE,
    ip VARCHAR(45) NOT NULL,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaction_id VARCHAR(50) NOT NULL UNIQUE,
    phone VARCHAR(20) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    router VARCHAR(50) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS failed_payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaction_id VARCHAR(50) DEFAULT NULL,
    phone VARCHAR(20) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    router VARCHAR(50) DEFAULT NULL,
    reason VARCHAR(100) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS speeds (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(50) NOT NULL,
    value VARCHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL
);

INSERT IGNORE INTO speeds (label, value) VALUES
    ('10 Mbps', '10M/10M'),
    ('20 Mbps', '20M/20M'),
    ('40 Mbps', '40M/40M');

INSERT IGNORE INTO routers (router, ip, name) VALUES
    ('router_a', '192.168.1.1', 'Supermarket');

-- Default admin: username=admin  password=admin123
INSERT IGNORE INTO admins (username, password_hash) VALUES
    ('admin', '$2y$10$ZB86xK7wI5uyTo8Gsm25iuOIvX0JNaM3rU9Ot3G3lKnCtecNCenZO');
