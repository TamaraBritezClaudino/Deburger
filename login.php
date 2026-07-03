<?php
  require_once "includes/config.php";

  if(isset($_POST)&&isset($_POST['submit'])){
    $correo = $_POST['correo'];
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM `clientes` WHERE email = '". $correo ."' AND pass = '". $password ."'";
echo $password;
echo $correo;
   $query = mysqli_query($conn, $sql);
   $fila=mysqli_num_rows($query);
   if($fila == 1){
      session_start();
$usuario = mysqli_fetch_assoc($query);
$_SESSION['usuario'] = $usuario;
    header("Location: index.php");
    exit(); 
  }

  }
 $section="views/login";
  require_once "views/layout.php";?>