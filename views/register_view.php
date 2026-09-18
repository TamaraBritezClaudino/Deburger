<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>

<main class="mainForm">
    <article>
        <img src="img/img_registro.png" alt="imgRegistro" class="imgRegistro">
    </article>

    <article class="form">
        <div>
            <h2>Crea tu cuenta</h2>
            <p>Es rápido, facil y gratis</p>
        </div>

        <form method="post">
            <div>
                <div>
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre">
                </div>

                <div>
                    <label for="apellido">Apellido</label>
                    <input type="text" id="apellido" name="apellido">
                </div>

            </div>

            <label for="correo">Correo electrónico</label>
            <input type="email" id="correo" name="correo">

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password">

            <div>
                <div>
                    <label for="fecha">Fecha de nacimiento</label>
                    <input type="date" id="fecha" name="fecha">
                </div>

                <div>
                    <label for="telefono">Teléfono (opcional)</label>
                    <input type="tel" id="telefono" name="telefono">
                </div>
            </div>

            <button type="submit" name="submit">
                Registrarme
            </button>

        </form>

        <p>
            ¿Ya tienes una cuenta?
            <a href="login.php">Inicia sesión</a>
        </p>
    </article>
</main>