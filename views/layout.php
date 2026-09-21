<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet">
    <script src="js/script.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="icon" type="image/png" href="img/deburger_icon.png">
</head>

<body>
    <header>
        <a href="index.php">
            <img src="img/Deburger.png" alt="Logo Deburger">
        </a>

        <nav>
            <a href="index.php">Inicio</a>
            <a href="aboutUs.php">Sobre nosotros</a>
            <a href="locals.php">Locales</a>
            <a href="support.php">Soporte</a>
        </nav>
<?php
session_start();
if(isset($_SESSION['usuario'])){
?>
        <i class="bi bi-person-fill"></i>
        <a href="#" class="NomUser"><?php echo $_SESSION['usuario']['nombre']?></a>
         <a href="cerrar_sesion.php" class="btnHeader cerrar">Cerrar Sesion</a>
        <?php
        
        }else{
            ?>
        <a href="login.php" class="btnHeader">Iniciar sesión</a>
        <?php 
        }
        ?>
    </header>

    <?php
    $section = (isset($section)) ? $section : 'home';
    require_once $section . '_view.php';
    ?>

    <footer>
        <p>© 2026 Deburger</p>
        <div>
            <a href="">Terminos de uso</a>
            <a href="">Politicas de privacidad</a>
        </div>
    </footer>
</body>

</html>