<?php
 require_once "includes/config.php";

  $error = "";

  if(isset($_POST['submit'])){

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $password = md5($_POST['password']);
    $fecha = $_POST['fecha'] !== '' ? $_POST['fecha'] : null;
    $telefono = $_POST['telefono'];

    // Verificar que el correo no esté registrado
    $chk = mysqli_prepare($conn, "SELECT 1 FROM clientes WHERE email = ?");
    mysqli_stmt_bind_param($chk, "s", $correo);
    mysqli_stmt_execute($chk);
    mysqli_stmt_store_result($chk);

    if (mysqli_stmt_num_rows($chk) > 0) {
      $error = "Ese correo ya está registrado.";
    } else {
      $ins = mysqli_prepare($conn, "INSERT INTO clientes (nombre, apellido, telefono, email, pass, fecha_nacimiento) VALUES (?,?,?,?,?,?)");
      mysqli_stmt_bind_param($ins, "ssssss", $nombre, $apellido, $telefono, $correo, $password, $fecha);

      if (mysqli_stmt_execute($ins)) {
        header("Location: login.php");
        exit();
      }
      $error = "No se pudo crear la cuenta. Intentá de nuevo.";
    }
  }

  if ($error !== "") {
    echo "<script>alert(" . json_encode($error) . ");</script>";
  }

  $section="views/register";
  require_once "views/layout.php";?>