-- TIT_datos.sql
USE `TIT_parcial_plp3`;

INSERT INTO TIT_categorias (nombre) VALUES
('Pizzas'),('Hamburguesas'),('Pastas'),('Regional'),('Sushi'),('Ensaladas'),('Milanesas'),('Postres'),('Tartas'),('Bebidas');

INSERT INTO TIT_productos (nombre, descripcion, precio, imagen, categoria_id) VALUES
('Pizza Margherita','Tomate, mozzarella y albahaca', 4500.00,'TIT_assets/images/pizza.svg',1),
('Pizza Napolitana','Tomate, ajo y mozzarella', 4800.00,'TIT_assets/images/pizza.svg',1),
('Hamburguesa Clásica','Medallón, lechuga y tomate', 4200.00,'TIT_assets/images/burger.svg',2),
('Hamburguesa Doble','Dos medallones, queso', 5200.00,'TIT_assets/images/burger.svg',2),
('Spaghetti Boloñesa','Salsa casera 6h', 4600.00,'TIT_assets/images/pasta.svg',3),
('Empanadas de Carne (x3)','Carne cortada a cuchillo', 3000.00,'TIT_assets/images/empanada.svg',4),
('Sushi Roll (8u)','Salmón y palta', 6500.00,'TIT_assets/images/sushi.svg',5),
('Ensalada Caesar','Pollo, croutons, parmesano', 3800.00,'TIT_assets/images/ensalada.svg',6),
('Milanesa Napolitana','Con jamón y queso', 5200.00,'TIT_assets/images/milanesa.svg',7),
('Limonada 500ml','Con menta', 1500.00,'TIT_assets/images/bebida.svg',10);
