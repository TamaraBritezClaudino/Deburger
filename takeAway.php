<?php
  require_once "includes/config.php";

  // Productos agrupados por categoría
  $menu = [];
  $res = mysqli_query($conn, "SELECT p.id_producto, p.nombre, p.precio, p.descripcion, c.nombre AS categoria
                              FROM productos p
                              LEFT JOIN categorias c ON c.id_categoria = p.id_categoria
                              ORDER BY c.id_categoria, p.id_producto");
  while ($fila = mysqli_fetch_assoc($res)) {
    $menu[$fila['categoria'] ?? 'otros'][] = $fila;
  }

  $section="views/takeAway";
  require_once "views/layout.php";?>