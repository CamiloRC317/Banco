<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco ADSO - Iniciar sesión</title>
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
    <main class="tarjeta" id="tarjeta-login">
        <header class="cabecera">
            <h1>Banco ADSO</h1>
            <p>Inicia sesión para ver tu cuenta</p>
        </header>

        <section class="contenido">
            <?php if (isset($error)): ?>
                <p class="mensaje-error" id="mensaje-error"><?= $error ?></p>
            <?php endif; ?>

            <form action="/login" method="POST" id="formulario-login">
                <div class="campo">
                    <label for="numero_cuenta">Número de cuenta</label>
                    <input class="entrada" type="text" id="numero_cuenta" name="numero_cuenta" required>
                </div>

                <div class="campo">
                    <label for="clave">Contraseña</label>
                    <input class="entrada" type="password" id="clave" name="clave" required>
                </div>

                <button class="boton" id="boton-ingresar" type="submit">Ingresar</button>
            </form>
        </section>
    </main>
</body>
</html>