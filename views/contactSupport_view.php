<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soporte</title>
</head>

<main id="contactSuportMain">
    <section class="soporte">
        <div class="titulo">
            <i class="bi bi-envelope"></i>
            <h1>Soporte</h1>
        </div>

        <p>¿No puedes encontrar lo que estas buscando? ¡No te preocupes! Ponte en contacto con el equipo de soporte, nos complace ayudar.</p>
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
        <form method="post">
            <label for="nombre">Nombre y apellido</label>
            <input type="text" id="nombre" name="nombre">

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


            <label for="reclamo">Detalle de tu reclamo</label>
            <textarea name="reclamo" id="reclamo"></textarea>


            <button type="submit" name="submit" class="btnEnviar">
                <p>Enviar</p>
                <i class="bi bi-arrow-right"></i>
            </button>
        </form>
    </section>
</main>