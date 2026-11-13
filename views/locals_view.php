
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locales</title>
</head>

<main id="mainLocales">
    <?php
    /** @var array $locales */
    ?>

    <section class="encabezadoLocales">
        <h1>Nuestros <strong>locales</strong></h1>
        <p>Encontrá tu Deburger más cercano</p>
    </section>

    <section class="contenidoLocales">

        <div class="panelLocales">

            <div class="buscar">
                <i class="bi bi-search"></i>
                <input type="search" id="buscarLocal"
                    placeholder="Buscar por localidad o dirección...">
            </div>

            <div class="cantidadLocales">
                <h2>Nuestras sucursales</h2>
                <span id="contadorLocales">
                    <?php echo count($locales); ?>
                    <?php echo count($locales) == 1 ? 'local' : 'locales'; ?>
                </span>
            </div>

            <section id="locales">
                <?php foreach ($locales as $i => $local) { ?>
                    <article class="tarjetaLocal"
                        data-id="<?php echo (int) $local['id_local']; ?>"
                        data-nombre="<?php echo htmlspecialchars($local['localidad'], ENT_QUOTES, 'UTF-8'); ?>"
                        data-direccion="<?php echo htmlspecialchars($local['direccion'], ENT_QUOTES, 'UTF-8'); ?>"
                        data-horario="<?php echo htmlspecialchars($local['horario'], ENT_QUOTES, 'UTF-8'); ?>"
                        data-lat="<?php echo htmlspecialchars($local['latitud'], ENT_QUOTES, 'UTF-8'); ?>"
                        data-lng="<?php echo htmlspecialchars($local['longitud'], ENT_QUOTES, 'UTF-8'); ?>">

                        <div class="numeroLocal">
                            <?php echo sprintf('%02d', $i + 1); ?>
                        </div>

                        <div class="infoLocal">

                            <h3>
                                <?php echo htmlspecialchars($local['nombre']); ?>
                            </h3>

                            <p>
                                <i class="bi bi-geo-alt"></i>
                                <?php echo htmlspecialchars($local['direccion']); ?>
                            </p>

                            <p>
                                <i class="bi bi-clock"></i>
                                <?php echo htmlspecialchars($local['horario']); ?>
                            </p>

                            <span class="estadoLocal <?php echo $local['estado_abierto'] ? 'abierto' : 'cerrado'; ?>">
                                <span></span>
                                <?php echo $local['estado_abierto'] ? 'Abierto ahora' : 'Cerrado ahora'; ?>
                            </span>
                        </div>

                        <button type="button" class="verLocal">
                            <i class="bi bi-arrow-up-right"></i>
                        </button>
                    </article>
                <?php } ?>

                <p id="sinResultados">
                    No encontramos locales con esa búsqueda.
                </p>

            </section>
        </div>

        <div class="contenedorMapa">
            <div class="tituloMapa">
                <div>
                    <h2>Encontranos cerca tuyo</h2>
                    <p>Explorá nuestras ubicaciones</p>
                </div>
                <i class="bi bi-geo-alt-fill"></i>
            </div>
            
            <div id="mapaLocales"></div>

            <div class="pieMapa">
                <i class="bi bi-info-circle"></i>
                Seleccioná una sucursal para ver su ubicación.
            </div>
        </div>
    </section>
</main>
