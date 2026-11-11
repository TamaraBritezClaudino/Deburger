<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>

<main class="mainForm">
    <?php
    /** @var array $valores */
    ?>
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
                    <input type="text" id="nombre" name="nombre"
                        placeholder="Ingresa tu nombre"
                        value="<?php echo htmlspecialchars($valores['nombre']); ?>"
                        required>
                </div>

                <div>
                    <label for="apellido">Apellido</label>
                    <input type="text" id="apellido" name="apellido"
                        placeholder="Ingresa tu apellido"
                        value="<?php echo htmlspecialchars($valores['apellido']); ?>"
                        required>
                </div>
            </div>

            <label for="correo">Correo electrónico</label>
            <input type="email" id="correo" name="correo"
                placeholder="Ingresa tu correo electrónico"
                value="<?php echo htmlspecialchars($valores['correo']); ?>"
                required>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>

            <div>
                <div>
                    <label for="fecha_nacimiento">Fecha de nacimiento</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"
                        value="<?php echo htmlspecialchars($valores['fecha_nacimiento']); ?>"
                        required>
                </div>

                <div>
                    <label for="telefono">Teléfono (opcional)</label>
                    <input type="tel" id="telefono" name="telefono"
                        placeholder="Ingresa tu número de teléfono"
                        value="<?php echo htmlspecialchars($valores['telefono']); ?>">
                </div>
            </div>

            <?php if ($error !== ""): ?>
                <p class="error">
                    <?php echo htmlspecialchars($error); ?>
                </p>
            <?php endif; ?>

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