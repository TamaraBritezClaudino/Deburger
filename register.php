<?php
 require_once "includes/config.php";

  if(isset($_POST)&&isset($_POST['submit'])){
   
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $password = md5($_POST['password']);
    $fecha = $_POST['fecha'];
    $telefono = $_POST['telefono'];

     $sql = "INSERT INTO `clientes`(`id_cliente`, `nombre`, `apellido`, `telefono`, `email`, `pass`, `fecha_nacimiento`)
   VALUES (NULL,'". $nombre ."','". $apellido ."','". $telefono ."','". $correo ."','". $password ."','". $fecha ."')";

  $query = mysqli_query($conn, $sql);
  Header("Location:login.php");
  }
 
  $section="views/register";
  require_once "views/layout.php";?>
  