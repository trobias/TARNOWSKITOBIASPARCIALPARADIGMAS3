-- TIT_estructura.sql
-- Estructura de BD para FoodExpress – Ruta B · Opción B
-- Prefijo: TIT_
CREATE DATABASE IF NOT EXISTS `TIT_parcial_plp3` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `TIT_parcial_plp3`;

DROP TABLE IF EXISTS TIT_pedido_items;
DROP TABLE IF EXISTS TIT_pedidos;
DROP TABLE IF EXISTS TIT_productos;
DROP TABLE IF EXISTS TIT_categorias;

CREATE TABLE TIT_categorias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(80) NOT NULL
);

CREATE TABLE TIT_productos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(120) NOT NULL,
  descripcion TEXT,
  precio DECIMAL(10,2) NOT NULL,
  imagen VARCHAR(255) DEFAULT NULL,
  categoria_id INT NOT NULL,
  FOREIGN KEY (categoria_id) REFERENCES TIT_categorias(id) ON DELETE RESTRICT
);

CREATE TABLE TIT_pedidos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  total DECIMAL(10,2) NOT NULL DEFAULT 0.00
);

CREATE TABLE TIT_pedido_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  pedido_id INT NOT NULL,
  producto_id INT NOT NULL,
  cantidad INT NOT NULL,
  precio_unit DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (pedido_id) REFERENCES TIT_pedidos(id) ON DELETE CASCADE,
  FOREIGN KEY (producto_id) REFERENCES TIT_productos(id) ON DELETE RESTRICT
);
