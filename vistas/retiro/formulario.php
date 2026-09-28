<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco ADSO - Retirar dinero</title>
    <link rel="stylesheet" href="/css/retiro-formulario.css">
</head>
<body>
    <main class="tarjeta" id="tarjeta-retiro">
        <header class="cabecera">
            <h1>Retirar dinero</h1>
            <p>El valor se descuenta de tu saldo al instante</p>
        </header>

        <section class="contenido">
            <?php if (isset($error)): ?>
                <p class="mensaje-error" id="mensaje-error"><?= $error ?></p>
            <?php endif; ?>

            <form action="/retiros" method="POST" id="formulario-retiro">
                <div class="campo">
                    <label for="valor">Valor a retirar</label>
                    <input class="entrada" type="number" id="valor" name="valor" step="0.01" min="0.01" required>
                </div>

                <button class="boton" id="boton-retirar" type="submit">Retirar</button>
            </form>

            <a class="enlace-volver" id="enlace-volver" href="/">Volver al panel</a>
        </section>
    </main>
</body>
</html>