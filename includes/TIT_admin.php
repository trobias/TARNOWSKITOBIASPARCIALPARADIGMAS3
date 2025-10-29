<?php include("TIT_conexion.php"); ?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Admin · FoodExpress (TIT)</title>
<link rel="stylesheet" href="../css/TIT_estilos.css">
</head>
<body>
<header class="top"><h1>Admin · FoodExpress</h1><nav><a href="../index.php">Tienda</a></nav></header>

<section class="card">
  <h2>Nuevo producto</h2>
  <form method="post">
    <input name="nombre" placeholder="Nombre" required>
    <input name="descripcion" placeholder="Descripción" required>
    <input name="precio" type="number" step="0.01" min="0.01" placeholder="Precio" required>
    <input name="imagen" placeholder="Ruta imagen (TIT_assets/images/pizza.svg)">
    <select name="categoria_id" required>
      <option value="">-- Categoría --</option>
      <?php
        $rc = mysqli_query($TIT_conn,"SELECT id, nombre FROM TIT_categorias ORDER BY nombre");
        while($c = mysqli_fetch_assoc($rc)){
          echo "<option value='{$c['id']}'>".htmlspecialchars($c['nombre'])."</option>";
        }
      ?>
    </select>
    <button type="submit" name="agregar">Agregar</button>
  </form>
  <?php
    if(isset($_POST['agregar'])){
      $n = $_POST['nombre']; $d = $_POST['descripcion']; $p = $_POST['precio']; $img = $_POST['imagen']; $cat = (int)$_POST['categoria_id'];
      $q = "INSERT INTO TIT_productos (nombre, descripcion, precio, imagen, categoria_id) VALUES ('$n','$d','$p','$img',$cat)";
      mysqli_query($TIT_conn,$q);
      echo "<p class='ok'>Producto agregado.</p>";
    }
    if(isset($_GET['eliminar'])){
      $id = (int)$_GET['eliminar'];
      mysqli_query($TIT_conn,"DELETE FROM TIT_productos WHERE id=$id");
      echo "<p class='ok'>Producto eliminado.</p>";
    }
  ?>
</section>

<section class="card">
  <h2>Listado de productos</h2>
  <table class="tabla">
    <thead><tr><th>ID</th><th>Nombre</th><th>Categoría</th><th>Precio</th><th>Acciones</th></tr></thead>
    <tbody>
    <?php
      $r = mysqli_query($TIT_conn,"SELECT p.id,p.nombre,p.precio,c.nombre AS categoria FROM TIT_productos p JOIN TIT_categorias c ON c.id=p.categoria_id ORDER BY c.nombre,p.nombre");
      while($p = mysqli_fetch_assoc($r)){
        echo "<tr>
          <td>{$p['id']}</td>
          <td>".htmlspecialchars($p['nombre'])."</td>
          <td>".htmlspecialchars($p['categoria'])."</td>
          <td>$ ".number_format($p['precio'],2,',','.')."</td>
          <td><a href='?eliminar={$p['id']}'>Eliminar</a></td>
        </tr>";
      }
    ?>
    </tbody>
  </table>
</section>
</body>
</html>
