<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locales</title>
</head>

<main id="mainLocales">
    <section class="encabezadoLocales">
        <h1>Nuestros <strong>locales</strong></h1>
        <p>Encontrá tu Deburger más cercano</p>
    </section>

    <section class="contenidoLocales">
        <div class="panelLocales">

            <div class="buscar">
                <i class="bi bi-search"></i>
                <input type="search" id="buscarLocal" placeholder="Buscar por localidad o dirección...">
            </div>

            <div class="cantidadLocales">
                <h2>Nuestras sucursales</h2>
                <span id="contadorLocales">3 locales</span>
            </div>

            <section id="locales">
                <article class="tarjetaLocal" data-nombre="Palermo" data-direccion="Av. Santa Fe 3200" data-horario="12:00 a 00:00" data-lat="-34.588" data-lng="-58.420">
                    <div class="numeroLocal">01</div>

                    <div class="infoLocal">
                        <h3>Deburger Palermo</h3>
                        <p>
                            <i class="bi bi-geo-alt"></i>
                            Av. Santa Fe 3200
                        </p>
                        <p>
                            <i class="bi bi-clock"></i>
                            12:00 a 00:00
                        </p>
                        <span class="estadoLocal">
                            <span></span> Horario habitual
                        </span>
                    </div>
                    <button type="button" class="verLocal">
                        <i class="bi bi-arrow-up-right"></i>
                    </button>
                </article>

                <article class="tarjetaLocal" data-nombre="Caballito" data-direccion="Av. Rivadavia 4800" ata-horario="12:00 a 00:00" data-lat="-34.619" data-lng="-58.440">
                    <div class="numeroLocal">02</div>
                    <div class="infoLocal">
                        <h3>Deburger Caballito</h3>
                        <p>
                            <i class="bi bi-geo-alt"></i>
                            Av. Rivadavia 4800
                        </p>
                        <p>
                            <i class="bi bi-clock"></i>
                            12:00 a 00:00
                        </p>
                        <span class="estadoLocal">
                            <span></span> Horario habitual
                        </span>
                    </div>
                    <button type="button" class="verLocal">
                        <i class="bi bi-arrow-up-right"></i>
                    </button>
                </article>
                <article class="tarjetaLocal" data-nombre="Belgrano" data-direccion="Av. Cabildo 2100" data-horario="12:00 a 00:00" data-lat="-34.562" data-lng="-58.456">
                    <div class="numeroLocal">03</div>
                    <div class="infoLocal">
                        <h3>Deburger Belgrano</h3>
                        <p>
                            <i class="bi bi-geo-alt"></i>
                            Av. Cabildo 2100
                        </p>
                        <p>
                            <i class="bi bi-clock"></i>
                            12:00 a 00:00
                        </p>
                        <span class="estadoLocal">
                            <span></span> Horario habitual
                        </span>
                    </div>

                    <button type="button" class="verLocal">
                        <i class="bi bi-arrow-up-right"></i>
                    </button>

                </article>

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
