<?php
require_once "includes/config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Pedidos del cliente (el más nuevo primero) con sus productos
$idCliente = (int) $_SESSION['usuario']['id_cliente'];
$pedidos = [];

$stmt = mysqli_prepare($conn,
    "SELECT p.id_pedido, p.fecha, p.total, p.estado, p.tipo_pago, p.tipo_entrega,
            dp.cantidad, pr.nombre, pr.precio
     FROM pedidos p
     LEFT JOIN detalle_pedidos dp ON dp.id_pedido = p.id_pedido
     LEFT JOIN productos pr ON pr.id_producto = dp.id_producto
     WHERE p.id_cliente = ?
     ORDER BY p.id_pedido DESC, dp.id_detalle ASC");
mysqli_stmt_bind_param($stmt, "i", $idCliente);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

while ($fila = mysqli_fetch_assoc($res)) {
    $id = $fila['id_pedido'];
    if (!isset($pedidos[$id])) {
        $pedidos[$id] = [
            'id' => $id,
            'fecha' => $fila['fecha'],
            'total' => $fila['total'],
            'estado' => $fila['estado'],
            'tipo_pago' => $fila['tipo_pago'],
            'tipo_entrega' => $fila['tipo_entrega'],
            'productos' => []
        ];
    }
    if ($fila['nombre'] !== null) {
        $pedidos[$id]['productos'][] = $fila;
    }
}

$section = "views/orders";
require_once "views/layout.php";
