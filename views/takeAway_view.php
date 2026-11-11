<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hacé tu pedido</title>
</head>

<main id="menuMain">
    <?php
    /** @var array $menu */
    ?>
    <section id="Banner">
        <div id="textoyboton">
            <h1>
                ¡Hace espacio para algo rico!
            </h1>

            <h2>No te quedes con las ganas</h2>

            <a href="#menu" class="btnamarillo">Ver menú ⭣</a>
        </div>
    </section>

    <section id="menu">
        <?php foreach ($menu as $categoria => $productos) { ?>
            <section class="menuSeccion">
                <div class="tituloMenu">
                    <span></span>
                    <h2><?php echo htmlspecialchars(ucfirst($categoria)); ?></h2>
                    <span></span>
                </div>

                <section class="tarjetasMenu">
                    <?php foreach ($productos as $prod) { ?>
                        <article class="tarjetaMenu"
                            data-id="<?php echo (int) $prod['id_producto']; ?>">
                            <div class="imagenProducto">
                                <?php if (!empty($prod['imagen'])) { ?>
                                    <img src="<?php echo htmlspecialchars($prod['imagen']); ?>" alt="<?php echo htmlspecialchars($prod['nombre']); ?>">
                                <?php } else { ?>
                                    <i class="bi bi-image"></i>
                                <?php } ?>
                            </div>

                            <div class="contenidoProducto">
                                <h3>
                                    <?php echo htmlspecialchars($prod['nombre']); ?>
                                </h3>

                                <p class="descripcionProducto">
                                    <?php echo htmlspecialchars($prod['descripcion']); ?>
                                </p>

                                <div class="precioProducto">
                                    <p>
                                        $<?php echo number_format($prod['precio'], 0, ',', '.'); ?>
                                    </p>
                                    <button type="button" class="add-to-cart" aria-label="Agregar <?php echo htmlspecialchars($prod['nombre']); ?> al carrito">
                                        <i class="bi bi-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </article>
                    <?php } ?>
                </section>
            </section>
        <?php } ?>
    </section>
</main>