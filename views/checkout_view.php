<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar compra</title>
</head>

<main id="mainCompra">

    <h1>Confirmar compra</h1>

    <form action="" method="POST" class="contenidoCompra">

        <!-- DATOS DEL CLIENTE -->
        <section class="datosCompra">

            <div class="tituloCompra">
                <div class="iconoCompra">
                    <i class="bi bi-person"></i>
                </div>

                <h2>Datos para el pedido</h2>
            </div>

            <hr>

            <div class="filaDatos">

                <div>
                    <label for="nombre">Nombre:</label>
                    <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        placeholder="Ingresa tu nombre">
                </div>

                <div>
                    <label for="apellido">Apellido:</label>
                    <input
                        type="text"
                        id="apellido"
                        name="apellido"
                        placeholder="Ingresa tu apellido">
                </div>

            </div>

            <div class="filaDatos">

                <div>
                    <label for="email">Email:</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Ingresa tu correo electrónico">
                </div>

                <div>
                    <label for="telefono">Teléfono:</label>
                    <input
                        type="tel"
                        id="telefono"
                        name="telefono"
                        placeholder="Ingresa tu número">
                </div>

            </div>

            <div class="campoCompleto">
                <label for="direccion">Dirección:</label>

                <input
                    type="text"
                    id="direccion"
                    name="direccion"
                    placeholder="Ingresa tu dirección">
            </div>

            <div class="campoCompleto">
                <label>Método de pago:</label>

                <div class="metodosPago">

                    <label>
                        <input type="radio" name="metodoPago" value="efectivo">
                        <span>Efectivo</span>
                    </label>

                    <label>
                        <input type="radio" name="metodoPago" value="tarjeta">
                        <span>Tarjeta de crédito/débito</span>
                    </label>

                    <label>
                        <input type="radio" name="metodoPago" value="mercadoPago">
                        <span>Mercado Pago</span>
                    </label>

                </div>
            </div>

            <button type="submit" name="confirmar" class="btnConfirmarCompra">
                <p>Confirmar pedido</p>
                <i class="bi bi-check-lg"></i>
            </button>

        </section>


        <!-- RESUMEN DEL PEDIDO -->
        <section class="resumenCompra">

            <div class="tituloCompra">
                <div class="iconoCompra">
                    <i class="bi bi-bag"></i>
                </div>

                <h2>Tu pedido</h2>
            </div>

            <hr>

            <div class="productoCompra">

                <div class="imagenProducto">
                    <img src="img/hamburguesa.jpg" alt="Hamburguesa clásica">
                </div>

                <div class="infoProducto">
                    <h3>Hamburguesa clásica</h3>
                    <p>Hamburguesa con queso, lechuga y tomate</p>

                    <div>
                        <span>Cantidad: 2</span>
                        <strong>$18.000</strong>
                    </div>
                </div>

            </div>

            <div class="productoCompra">

                <div class="imagenProducto">
                    <img src="img/papas.jpg" alt="Papas fritas">
                </div>

                <div class="infoProducto">
                    <h3>Papas fritas</h3>
                    <p>Papas fritas clásicas</p>

                    <div>
                        <span>Cantidad: 1</span>
                        <strong>$4.500</strong>
                    </div>
                </div>

            </div>

            <hr>

            <div class="totalCompra">
                <p>Total</p>
                <strong>$22.500</strong>
            </div>

        </section>

    </form>

</main>