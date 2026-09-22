<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="css/styles.css" rel="stylesheet">

    <script src="js/script.js" defer></script>

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <link rel="icon" type="image/png" href="img/deburger_icon.png">
</head>


<body>
    <header>
        <a href="index.php">
            <img src="img/Deburger.png" alt="Logo Deburger">
        </a>

        <nav>
            <a href="index.php">Inicio</a>
            <a href="takeAway.php">Hace tu pedido</a>
            <a href="locals.php">Locales</a>
            <a href="support.php">Soporte</a>
        </nav>

        <?php
        session_start();
        if (isset($_SESSION['usuario'])) { ?>
            <div class="usuario" onclick="toggleMenu()">
                <i class="bi bi-person-fill"></i>

                <p class="NomUser"><?php echo $_SESSION['usuario']['nombre'] ?></p> <!--Donde deberia ir el menu desplegable wa-->
            </div>

            <div class="sub-menu-wrap" id="subMenu">
                <div class="sub-menu">
                    <div class="user-info">
                        <i class="bi bi-person-fill"></i>
                        <p class="NomUser"><?php echo $_SESSION['usuario']['nombre'] ?></p>
                    </div>
                    <hr>
                    <a href="#" class="sub-menu-link">
                        <i class="bi bi-gear"></i>
                        <p>Configuración</p>
                        <span>></span>
                    </a>

                    <a href="#" class="sub-menu-link">
                        <i class="bi bi-question-circle"></i>
                        <p>Soporte</p>
                        <span>></span>
                    </a>

                    <a href="cerrar_sesion.php" class="sub-menu-link">
                        <i class="bi bi-box-arrow-left"></i>
                        <p>Cerrar sesión</p>
                        <span>></span>
                    </a>
                </div>
            </div>
        <?php
        } else {
        ?>
            <a href="login.php" class="btnHeader">Iniciar sesión</a>
        <?php
        }
        ?>

        <div class="cart-icon">
            <i class="bi bi-cart"></i>
            <span>0</span> <!--Cantidad de productos pedidos-->
        </div>
    </header>

    <!--Carrito-->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-close">
            <i class="bi bi-x-lg"></i>
        </div>

        <div class="cart-menu">
            <div>
                <h3>
                    <i class="bi bi-bag"></i>
                    Mi Pedido
                    <span class="cart-number">0</span>
                </h3>

                <div class="cart-items">
                    <!-- JavaScript agrega los productos acá -->
                </div>
            </div>

            <div class="sidebar--footer">
                <div class="total--amount">
                    <h5>Total del Carrito</h5>

                    <div class="cart-total">
                        $0.00
                    </div>
                </div>
                <button class="checkout-btn">Confirmar compra</button>
                <button class="continue-btn">Seguir Comprando</button>
            </div>
        </div>
    </div>

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