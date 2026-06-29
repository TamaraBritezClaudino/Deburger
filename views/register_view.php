<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <main>

        <section>

            <article>

                <h1>Únete a la experiencia</h1>

                <p>
                    Crea tu cuenta y disfruta promociones, beneficios y mucho más.
                </p>

                <img src="img/hamburguesa.png" alt="Hamburguesa">

            </article>

            <article>

                <h2>Crea tu cuenta</h2>

                <form>

                    <label for="nombre">Nombre</label><br>
                    <input type="text" id="nombre" name="nombre"><br><br>

                    <label for="apellido">Apellido</label><br>
                    <input type="text" id="apellido" name="apellido"><br><br>

                    <label for="correo">Correo electrónico</label><br>
                    <input type="email" id="correo" name="correo"><br><br>

                    <label for="password">Contraseña</label><br>
                    <input type="password" id="password" name="password"><br><br>

                    <label for="confirmar">Confirmar contraseña</label><br>
                    <input type="password" id="confirmar" name="confirmar"><br><br>

                    <label for="fecha">Fecha de nacimiento</label><br>
                    <input type="date" id="fecha" name="fecha"><br><br>

                    <label for="telefono">Teléfono (opcional)</label><br>
                    <input type="tel" id="telefono" name="telefono"><br><br>

                    <input type="checkbox" id="terminos">
                    <label for="terminos">
                        Acepto los términos y condiciones y la política de privacidad.
                    </label>

                    <br><br>

                    <button type="submit">
                        Registrarme
                    </button>

                </form>

                <p>
                    ¿Ya tienes una cuenta?
                    <a href="login.html">Inicia sesión</a>
                </p>

            </article>

        </section>

    </main>
</body>
</html>