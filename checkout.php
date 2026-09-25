<?php
require_once "includes/config.php";

if (session_status() === PHP_SESSION_NONE) {
}

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

  $section="views/checkout";
  require_once "views/layout.php";?>