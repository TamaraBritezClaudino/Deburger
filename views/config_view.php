<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración</title>
</head>

<main id="mainConfig">
    <h1>Configuración</h1>

    <div class="mostrarDatos">
        <div class="datos">
            <h2>Datos personales</h2>
            <button id="editarBtn">
                <i class="bi bi-pen"></i>
                <p>Editar</p>
            </button>
        </div>
        <hr>

        <div class="datosSec">
            <div>
                <p>Nombre:</p>
                <p>
                    <?php echo $_SESSION['usuario']['nombre'] ?>
                </p>
            </div>
            <div>
                <p>Apellido:</p>
                <p>
                    <?php echo $_SESSION['usuario']['apellido'] ?>
                </p>
            </div>
        </div>

        <div class="datosSec">
            <div>
                <p>Email:</p>
                <p>
                    <?php echo $_SESSION['usuario']['email'] ?>
                </p>
            </div>
            <div>
                <p>Teléfono:</p>
                <p>
                    <?php echo $_SESSION['usuario']['telefono'] ?>
                </p>
            </div>
        </div>

        <p>Direccion:</p>
        <p>Direccion generica 1234</p>
    </div>

    <div class="cambiarDatos">
        <div class="datos">
            <h2>Datos personales</h2>
        </div>
        <hr>

        <div class="datosSec">
            <div>
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" placeholder="Ingresa tu nombre" value="<?php echo $_SESSION['usuario']['nombre'] ?>">
            </div>

            <div>
                <label for="lastname">Apellido:</label>
                <input type="text" name="lastname" id="lastname" placeholder="Ingresa tu nombre" value="<?php echo $_SESSION['usuario']['apellido'] ?>">
            </div>
        </div>

        <div class="datosSec">
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Ingresa tu correo electronico" value="<?php echo $_SESSION['usuario']['email'] ?>">
            </div>

            <div>
                <label>Teléfono:</label>
                <input type="tel" name="" id="" placeholder="Ingresa tu número de teléfono" value="<?php echo $_SESSION['usuario']['telefono'] ?>">
            </div>
        </div>

        <label>Direccion:</label>
        <input type="text" name="" id="" value="<?php echo $_SESSION['usuario']['telefono'] ?>">

        <div class="botones">
            <button class="confirmarbtn" id="confirmarBtn">
                <i class="bi bi-check-lg"></i>
                <p>Confirmar</p>
            </button>

            <button class="cancelarbtn" id="cancelarBtn">
                <i class="bi bi-x-lg"></i>
                <p>Cancelar</p>
            </button>
        </div>
    </div>
</main>