<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hacé tu pedido</title>
</head>

<main id="menuMain">
    <section id="carrusel">
        <img src="img/Banner2.png" alt="img_inicio">
    </section>

    <section id="menu">
        <?php
        foreach ($menu as $categoria => $productos) { ?>
        <section class="menuSeccion">
            <h2><?php echo htmlspecialchars(ucfirst($categoria)); ?></h2>

            <section class="tarjetasMenu">
                <?php foreach ($productos as $prod) { ?>
                <div class="card tarjetaMenu">
                    <img src="" alt="">
                    <div>
                        <h3 class="card-title"><?php echo htmlspecialchars($prod['nombre']); ?></h3>
                        <p class="card-description"><?php echo htmlspecialchars($prod['descripcion']); ?></p>
                        <div>
                            <p class="price">$<?php echo number_format($prod['precio'], 0, ',', '.'); ?></p>
                            <i class="bi bi-cart-plus add-to-cart"></i>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </section>
        </section>
        <?php } ?>
    </section>
</main>