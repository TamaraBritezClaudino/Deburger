<?php
require_once "includes/config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Si la base todavía no tiene la columna direccion, se agrega sola (una única vez)
$col = mysqli_query($conn, "SHOW COLUMNS FROM clientes LIKE 'direccion'");
if ($col && mysqli_num_rows($col) === 0) {
    mysqli_query($conn, "ALTER TABLE clientes ADD COLUMN direccion varchar(255) DEFAULT NULL AFTER telefono");
}

$error = "";

if (isset($_POST['guardarPerfil'])) {

    $idCliente = (int) $_SESSION['usuario']['id_cliente'];
    $nombre    = trim($_POST['nombre'] ?? '');
    $apellido  = trim($_POST['apellido'] ?? '');
    $correo    = trim($_POST['email'] ?? '');
    $telefono  = trim($_POST['telefono'] ?? '');
    $direccion = trim($_POST['direccion'] ?? '');

    if ($nombre === '' || $apellido === '') {
        $error = "El nombre y el apellido no pueden estar vacíos.";
    } elseif (strpos($correo, '@') === false) {
        $error = "Ingresá un correo válido.";
    } elseif (strlen($telefono) > 20) {
        $error = "El teléfono es demasiado largo.";
    } else {
        // El correo no puede ser de otra cuenta
        $chk = mysqli_prepare($conn, "SELECT 1 FROM clientes WHERE email = ? AND id_cliente <> ?");
        mysqli_stmt_bind_param($chk, "si", $correo, $idCliente);
        mysqli_stmt_execute($chk);
        mysqli_stmt_store_result($chk);

        if (mysqli_stmt_num_rows($chk) > 0) {
            $error = "Ese correo ya está registrado en otra cuenta.";
        } else {
            $upd = mysqli_prepare($conn, "UPDATE clientes SET nombre = ?, apellido = ?, email = ?, telefono = ?, direccion = ? WHERE id_cliente = ?");
            mysqli_stmt_bind_param($upd, "sssssi", $nombre, $apellido, $correo, $telefono, $direccion, $idCliente);

            if (mysqli_stmt_execute($upd)) {
                // Volver a cargar los datos guardados en la sesión
                $sel = mysqli_prepare($conn, "SELECT * FROM clientes WHERE id_cliente = ?");
                mysqli_stmt_bind_param($sel, "i", $idCliente);
                mysqli_stmt_execute($sel);
                $_SESSION['usuario'] = mysqli_fetch_assoc(mysqli_stmt_get_result($sel));

                header("Location: config.php");
                exit();
            }
            $error = "No se pudieron guardar los cambios. Intentá de nuevo.";
        }
    }
}

if ($error !== "") {
    echo "<script>alert(" . json_encode($error) . ");</script>";
}

$section = "views/config";
require_once "views/layout.php";
