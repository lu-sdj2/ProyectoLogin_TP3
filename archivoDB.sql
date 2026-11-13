CREATE DATABASE IF NOT EXISTS proyecto_log;
USE proyecto_log;

-- Creamos el usuario local y lo limitamos solo a esta base de datos
CREATE USER IF NOT EXISTS 'LuciaOrtiz'@'localhost' IDENTIFIED BY 'user.123$';
GRANT ALL PRIVILEGES ON proyecto_log.* TO 'LuciaOrtiz'@'localhost';
FLUSH PRIVILEGES;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);