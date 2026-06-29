<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet">
    <script src="js/script.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>

<body>
    <header>
        <a href="index.php">
            <img src="img/logoDeburger.png" alt="Logo Deburger">
        </a>

        <nav>
            <a href="#">Inicio</a>
            <a href="#">Sobre nosotros</a>
            <a href="#">Locales</a>
            <a href="#">Soporte</a>
        </nav>

        <a href="login.php" class="btnHeader">Iniciar sesión</a>
    </header>

    <?php
    $section = (isset($section)) ? $section : 'home';
    require_once $section . '_view.php';
    ?>

    <footer>
        <p>© 2026 Deburger</p>
    </footer>
</body>

</html>