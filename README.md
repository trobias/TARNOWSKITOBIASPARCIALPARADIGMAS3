# FoodExpress – TIT (Ruta B · Opción B)

**Alumno:** Tobias Ian Tarnowski  
**Cátedra:** PLP III · UCP · 29/10/2025

## 💡 Resumen
Sistema de pedidos online con catálogo, filtros, carrito dinámico y registro de pedidos en MySQL.  

## 🗂 Estructura (exigida por consigna)
```
TIT_Parcial_PLP3/
├─ index.html
├─ css/TIT_estilos.css
├─ js/TIT_script.js
├─ includes/TIT_conexion.php
├─ includes/TIT_api.php
├─ includes/TIT_admin.php
├─ TIT_assets/images/*
├─ database/TIT_estructura.sql
├─ database/TIT_datos.sql
├─ docs/Tarnowski_Tobias_Ian_Parcial.pdf
└─ README.md
```

## 🛠 Instalación (XAMPP)
1. Copiar la carpeta `TIT_Parcial_PLP3` a `htdocs/`.
2. En **phpMyAdmin** crear la BD importando, en este orden:
   - `database/TIT_estructura.sql`
   - `database/TIT_datos.sql`
3. Abrir en el navegador: `http://localhost/TIT_Parcial_PLP3/index.html`  
   Panel admin: `http://localhost/TIT_Parcial_PLP3/includes/TIT_admin.php`


## 🧪 Pruebas rápidas
- Filtrar por categoría y agregar productos al carrito.
- Modificar cantidades; ver subtotales y total.
- Confirmar pedido (crea `TIT_pedidos` + `TIT_pedido_items`).
- En panel admin: crear, editar y eliminar productos.

