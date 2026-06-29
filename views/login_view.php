<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
</head>

<body>
    <main class="mainForm">
        <article>
            <img src="img/img_login.png " class="imgLogin" alt="">
        </article>

        <article class="form">
            <div>
                <h2>Bienvenido de nuevo</h2>

                <p>
                    Inicia sesión para continuar disfrutando de nuestras mejores hamburguesas.
                </p>
            </div>

            <form>
                <label for="correo">Correo electrónico</label>
                <input type="email" id="correo" name="correo">

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password">

                <button type="submit">
                    Iniciar sesión
                </button>

            </form>

            <p>
                ¿No tienes una cuenta?
                <a href="register.php">Regístrate aquí</a>
            </p>
        </article>
    </main>
</body>

</html>