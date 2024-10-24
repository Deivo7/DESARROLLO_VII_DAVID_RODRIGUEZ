# Sistema de Gestión de Biblioteca

Este proyecto implementa un sistema simple de gestión de biblioteca utilizando PHP. Se han desarrollado dos versiones del sistema: una utilizando MySQLi y otra utilizando PDO.

## Instrucciones de Configuración

### Requisitos

- PHP 7.4 o superior
- Servidor web (Laragon)
- MySQL 5.7 o superior

### Estructura de la Base de Datos

Ejecuta las siguientes consultas SQL para crear la base de datos y las tablas necesarias:

sql
CREATE DATABASE biblioteca;
USE biblioteca;
CREATE TABLE usuarios (
id INT AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(100) NOT NULL,
email VARCHAR(100) NOT NULL UNIQUE,
contrasena VARCHAR(255) NOT NULL
);
CREATE TABLE libros (
id INT AUTO_INCREMENT PRIMARY KEY,
titulo VARCHAR(255) NOT NULL,
autor VARCHAR(255) NOT NULL,
isbn VARCHAR(13) NOT NULL UNIQUE,
anio INT NOT NULL,
cantidad INT NOT NULL
);

CREATE TABLE prestamos (
id INT AUTO_INCREMENT PRIMARY KEY,
usuario_id INT NOT NULL,
libro_id INT NOT NULL,
fecha_prestamo DATETIME NOT NULL,
fecha_devolucion DATETIME,
FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
FOREIGN KEY (libro_id) REFERENCES libros(id)
);


### Configuración

1. Clona este repositorio en tu servidor web.
2. Configura la conexión a la base de datos en los archivos `config.php` dentro de las carpetas `mysqli` y `pdo`.
3. Asegúrate de que el servidor web tenga permisos de escritura en el directorio donde se encuentra el archivo `errores.log`.

## Estructura del Proyecto
TALLER_8/
├── mysqli/
│ ├── config.php
│ ├── libros.php
│ ├── usuarios.php
│ ├── prestamos.php
│ └── index.php
├── pdo/
│ ├── config.php
│ ├── libros.php
│ ├── usuarios.php
│ ├── prestamos.php
│ └── index.php
└── README.md