<?php
// Conexión sencilla (mysqli) a la BD completa con categorías/productos/pedidos/items
$TIT_conn = mysqli_connect("127.0.0.1", "root", "", "TIT_parcial_plp3");
if(!$TIT_conn){ die("Error de conexión: ".mysqli_connect_error()); }
mysqli_set_charset($TIT_conn, "utf8mb4");
?>