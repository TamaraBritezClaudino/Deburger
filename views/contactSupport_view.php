<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soporte</title>
</head>

<main id="contactSuportMain">
    <section>
        <i class="bi bi-envelope"></i>
        <h1>Soporte</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit morbi, dui fringilla metus maecenas erat sem malesuada, vestibulum id sociosqu vulputate eros scelerisque eget. Eget mattis odio fames ullamcorper mollis tristique himenaeos metus, inceptos convallis phasellus malesuada turpis pellentesque mauris litora aliquam, volutpat per platea arcu ligula sed vestibulum.</p>
        <hr>
        <div>
            <i class="bi bi-envelope"></i>
            <p>soporte@deburger.com</p>
        </div>
        <div>
            <i class="bi bi-telephone"></i>
            <p>xx-xxxxxxx</p>
        </div>
    </section>

    <section class="form">
        <div>
            <h2>Realizar un reclamo</h2>
            <p>Si tu pedido fue online y tenes algun inconveniente, completa el siguiente formulario</p>
        </div>

        <form method="post">
            <div>
                <label for="nombre">Nombre y apellido</label>
                <input type="text" id="nombre" name="nombre">
            </div>

            <div>
                <div>
                    <label for="correo">Correo electrónico</label>
                    <input type="email" name="correo" id="correo">
                </div>

                <div>
                    <label for="telefono">Teléfono (opcional)</label>
                    <input type="tel" id="telefono" name="telefono">
                </div>
            </div>

            <div>
                <label for="reclamo">Detalle de tu reclamo</label>
                <textarea name="reclamo" id="reclamo"></textarea>
            </div>

            <button type="submit" name="submit">
                <p>Enviar</p>
                <i class="bi bi-arrow-right"></i>
            </button>

        </form>
    </section>
</main>