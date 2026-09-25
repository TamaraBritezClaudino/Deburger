<?php
  require_once "includes/config.php";

  $MAX_INTENTOS = 3; // cantidad de intentos antes de bloquear la cuenta

  if(isset($_POST['submit'])){
    $correo = $_POST['correo'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM `clientes` WHERE email = '". $correo ."'";
    $query = mysqli_query($conn, $sql);
    $cliente = mysqli_fetch_assoc($query);

    if(!$cliente){
    echo "<script>alert('El correo o la contraseña son incorrectos.');</script>";

    } elseif($cliente['bloqueado'] == 1){

     echo "<script>alert('La cuenta está bloqueada.');</script>";

    } elseif($cliente['pass'] != $password){

      $intentos = $cliente['intentos_fallidos'] + 1;
      $bloqueado = ($intentos >= $MAX_INTENTOS) ? 1 : 0;

      $sqlUpdate = "UPDATE clientes SET intentos_fallidos = $intentos, bloqueado = $bloqueado WHERE id_cliente = ". $cliente['id_cliente'];
      mysqli_query($conn, $sqlUpdate);

      if($bloqueado){
        echo "<script>alert('La cuenta ha sido bloqueada por demasiados intentos fallidos.');</script>";
      } else {
        echo "<script>alert('El correo o la contraseña son incorrectos.');</script>";
      }

    } else {

      session_start();

      $sqlReset = "UPDATE clientes SET intentos_fallidos = 0 WHERE id_cliente = ". $cliente['id_cliente'];
      mysqli_query($conn, $sqlReset);

      $_SESSION['usuario'] = $cliente;
      header("Location: index.php");
      exit();
    }
  }

  $section = "views/login";
  require_once "views/layout.php";
 
  ?>