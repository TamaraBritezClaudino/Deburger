<?php
require_once "includes/config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$error = '';

if (isset($_POST['confirmar'])) {

    $metodos = [
        'efectivo'    => 'Efectivo',
        'tarjeta'     => 'Tarjeta'
    ];

    $metodo   = $_POST['metodoPago'] ?? '';
    $direccion = trim($_POST['direccion'] ?? '');
    $carrito  = json_decode($_POST['carrito'] ?? '[]', true);

    if (!isset($metodos[$metodo])) {
        $error = 'Elegí un método de pago.';
    } elseif (!is_array($carrito) || count($carrito) === 0) {
        $error = 'Tu pedido está vacío.';
    } else {

        // Con dirección es Delivery, sin dirección es Retiro
        $tipoEntrega = ($direccion !== '') ? 'Delivery' : 'Retiro';
        $tipoPago    = $metodos[$metodo];
        $idCliente   = (int) $_SESSION['usuario']['id_cliente'];

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            // Buscar cada producto en la BD (el precio NO se toma del navegador)
            $items = []; // id_producto => cantidad
            $porId     = mysqli_prepare($conn, "SELECT id_producto FROM productos WHERE id_producto = ?");
            $porNombre = mysqli_prepare($conn, "SELECT id_producto FROM productos WHERE nombre = ?");

            foreach ($carrito as $it) {
                $cant = max(1, min(99, (int) ($it['quantity'] ?? 1)));
                $idProd = null;

                if (isset($it['id']) && ctype_digit((string) $it['id'])) {
                    $id = (int) $it['id'];
                    mysqli_stmt_bind_param($porId, "i", $id);
                    mysqli_stmt_execute($porId);
                    $r = mysqli_fetch_assoc(mysqli_stmt_get_result($porId));
                    $idProd = $r['id_producto'] ?? null;
                } elseif (isset($it['name'])) {
                    $nombre = (string) $it['name'];
                    mysqli_stmt_bind_param($porNombre, "s", $nombre);
                    mysqli_stmt_execute($porNombre);
                    $r = mysqli_fetch_assoc(mysqli_stmt_get_result($porNombre));
                    $idProd = $r['id_producto'] ?? null;
                }

                if ($idProd === null) {
                    throw new Exception('Un producto de tu pedido ya no está disponible.');
                }

                $items[$idProd] = ($items[$idProd] ?? 0) + $cant;
            }

            mysqli_begin_transaction($conn);

            // El total lo calcula el trigger calcular_total_pedido al insertar el detalle
            $stmtPedido = mysqli_prepare($conn,
                "INSERT INTO pedidos (id_cliente, fecha, tipo_pago, total, estado, tipo_entrega)
                 VALUES (?, CURDATE(), ?, 0, 'Pendiente', ?)");
            mysqli_stmt_bind_param($stmtPedido, "iss", $idCliente, $tipoPago, $tipoEntrega);
            mysqli_stmt_execute($stmtPedido);
            $idPedido = mysqli_insert_id($conn);

            $stmtDetalle = mysqli_prepare($conn,
                "INSERT INTO detalle_pedidos (id_pedido, cantidad, id_producto) VALUES (?, ?, ?)");
            foreach ($items as $idProd => $cant) {
                mysqli_stmt_bind_param($stmtDetalle, "iii", $idPedido, $cant, $idProd);
                mysqli_stmt_execute($stmtDetalle);
            }

            mysqli_commit($conn);

            header("Location: orders.php?nuevo=1");
            exit();

        } catch (Throwable $e) {
            try { mysqli_rollback($conn); } catch (Throwable $e2) {}
            // Se muestra el motivo real para poder encontrar el problema
            $error = 'No se pudo confirmar el pedido: ' . $e->getMessage();
        }
    }
}

$section = "views/checkout";
require_once "views/layout.php";
