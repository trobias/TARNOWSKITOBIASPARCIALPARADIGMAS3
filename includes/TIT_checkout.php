<?php
// Inserta el pedido y sus items con mysqli
include("TIT_conexion.php");
if($_SERVER["REQUEST_METHOD"]!=="POST"){ header("Location: ../index.php"); exit; }

$items = $_POST["items"] ?? []; // array de cadenas "id|qty"
if(!is_array($items) || count($items)==0){
  echo "<script>alert('Carrito vacío');window.location='../index.php';</script>"; exit;
}

mysqli_begin_transaction($TIT_conn);
try{
  mysqli_query($TIT_conn, "INSERT INTO TIT_pedidos (fecha,total) VALUES (NOW(),0)");
  $pedido_id = mysqli_insert_id($TIT_conn);
  $total = 0;

  $stmtProd = mysqli_prepare($TIT_conn, "SELECT precio FROM TIT_productos WHERE id=?");
  $stmtItem = mysqli_prepare($TIT_conn, "INSERT INTO TIT_pedido_items(pedido_id, producto_id, cantidad, precio_unit) VALUES (?,?,?,?)");

  foreach($items as $raw){
    list($pid,$qty) = array_map('intval', explode('|',$raw));
    if($pid<=0 || $qty<=0) continue;
    mysqli_stmt_bind_param($stmtProd, "i", $pid);
    mysqli_stmt_execute($stmtProd);
    $res = mysqli_stmt_get_result($stmtProd);
    if($row = mysqli_fetch_assoc($res)){
      $precio = (float)$row["precio"];
      $total += $precio * $qty;
      mysqli_stmt_bind_param($stmtItem, "iiid", $pedido_id, $pid, $qty, $precio);
      mysqli_stmt_execute($stmtItem);
    }
  }

  $up = mysqli_prepare($TIT_conn, "UPDATE TIT_pedidos SET total=? WHERE id=?");
  mysqli_stmt_bind_param($up, "di", $total, $pedido_id);
  mysqli_stmt_execute($up);

  mysqli_commit($TIT_conn);
  echo "<script>alert('Pedido #{$pedido_id} registrado. Total: $'+({$total}));window.location='../index.php';</script>";
}catch(Exception $e){
  mysqli_rollback($TIT_conn);
  echo "<script>alert('Error al guardar el pedido');window.location='../index.php';</script>";
}
?>