<?php include(__DIR__.'/includes/TIT_conexion.php'); ?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>TIT · FoodExpress</title>
<link rel="stylesheet" href="css/TIT_estilos.css">
</head>
<body>
<header class="top">
  <h1>FoodExpress · TIT</h1>
  <nav>
    <form method="get" class="inl">
      <label>Categoria:
        <select name="cat" onchange="this.form.submit()">
          <option value="">Todas</option>
          <?php
            $catSel = isset($_GET['cat']) ? (int)$_GET['cat'] : 0;
            $rc = mysqli_query($TIT_conn,"SELECT id,nombre FROM TIT_categorias ORDER BY nombre");
            while($c = mysqli_fetch_assoc($rc)){
              $sel = ($catSel== (int)$c['id']) ? "selected" : "";
              echo "<option value='{$c['id']}' $sel>".htmlspecialchars($c['nombre'])."</option>";
            }
          ?>
        </select>
      </label>
    </form>
    <a href="includes/TIT_admin.php">Admin</a>
    <span class="badge">Carrito: <b id="TIT_badge">0</b></span>
  </nav>
</header>

<main class="wrap">
  <section class="menu">
    <h2>Menú</h2>
    <div class="grid">
      <?php
        if($catSel>0){
          $q = "SELECT p.id,p.nombre,p.descripcion,p.precio,p.imagen,c.nombre AS categoria
                FROM TIT_productos p JOIN TIT_categorias c ON c.id=p.categoria_id
                WHERE p.categoria_id=$catSel ORDER BY p.nombre";
        } else {
          $q = "SELECT p.id,p.nombre,p.descripcion,p.precio,p.imagen,c.nombre AS categoria
                FROM TIT_productos p JOIN TIT_categorias c ON c.id=p.categoria_id
                ORDER BY c.nombre,p.nombre";
        }
        $res = mysqli_query($TIT_conn,$q);
        while($p = mysqli_fetch_assoc($res)){
          $n = htmlspecialchars($p['nombre'],ENT_QUOTES);
          echo "<article class='card'>
            <img src='".($p['imagen'] ?: "TIT_assets/images/pizza.svg")."' alt='{$n}'>
            <span class='chip'>".htmlspecialchars($p['categoria'])."</span>
            <h3>{$n}</h3>
            <p>".htmlspecialchars($p['descripcion'])."</p>
            <p class='precio'>$ ".number_format($p['precio'],2,',','.')."</p>
            <button onclick=\"TIT_add({$p['id']}, '{$n}', {$p['precio']})\">Agregar</button>
          </article>";
        }
      ?>
    </div>
  </section>

  <aside class="carrito card">
    <h2>🛒 Carrito</h2>
    <ul id="TIT_list"></ul>
    <p class="total">Total: $ <span id="TIT_total">0</span></p>
    <form id="TIT_form" method="post" action="includes/TIT_checkout.php">
      <div id="TIT_hidden"></div>
      <button type="submit">Confirmar pedido</button>
    </form>
  </aside>
</main>

<script src="js/TIT_script.js"></script>
</body>
</html>
