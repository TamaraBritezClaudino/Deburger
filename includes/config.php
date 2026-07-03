<?php
$conn = mysqli_connect("localhost","root", "", "deburger");

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

?>