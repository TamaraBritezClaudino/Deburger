<?php
 require_once "includes/config.php";

  $error = "";

  $valores = [
    'nombre' => '',
    'apellido' => '',
    'correo' => '',
    'fecha_nacimiento' => '',
    'telefono' => ''
  ];

  if(isset($_POST['submit'])){

    $valores = [
      'nombre' => $_POST['nombre'] ?? '',
      'apellido' => $_POST['apellido'] ?? '',
      'correo' => $_POST['correo'] ?? '',
      'fecha_nacimiento' => $_POST['fecha_nacimiento'] ?? '',
      'telefono' => $_POST['telefono'] ?? ''
    ];

    $nombre = $valores['nombre'];
    $apellido = $valores['apellido'];
    $correo = $valores['correo'];
    $password = md5($_POST['password']);
    $fecha = $valores['fecha_nacimiento'];
    $telefono = $valores['telefono'] !== '' ? $valores['telefono'] : null;

    // Verificar que el cliente tenga 16 años o más
    if (!empty($fecha)) {
    $fechaNacimiento = DateTime::createFromFormat('!Y-m-d', $fecha);
    $edadMinima = new DateTime('-16 years');

    if (!$fechaNacimiento || $fechaNacimiento->format('Y-m-d') != $fecha) {
        $error = "La fecha de nacimiento no es válida.";
    }
    else if ($fechaNacimiento > $edadMinima) {
        $error = "Debes tener al menos 16 años para registrarte.";
    }
}

    // Verificar que el correo no esté registrado
    if ($error === "") {
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
  }

  $section = "views/register";
  require_once "views/layout.php";
?>
