<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soporte</title>
</head>

<main>
    <article class="form">
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

        <p>
            ¿Ya tienes una cuenta?
            <a href="login.php">Inicia sesión</a>
        </p>
    </article>

<!--A partir de aca podriamos poner preguntas frecuentes y medio de contacto... tengo sueño, me quiero jubilar y ni empece a trabajar AHHHHHHHHHHHHHHHHHHHHHHHHHHHH-->
</main>