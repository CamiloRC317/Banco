<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco ADSO - Transferir dinero</title>
    <link rel="stylesheet" href="/css/transferencia-formulario.css">
</head>
<body>
    <main class="tarjeta" id="tarjeta-transferencia">
        <header class="cabecera">
            <h1>Transferir dinero</h1>
            <p>Envía dinero a otra cuenta del banco</p>
        </header>

        <section class="contenido">
            <?php if (isset($error)): ?>
                <p class="mensaje-error" id="mensaje-error"><?= $error ?></p>
            <?php endif; ?>

            <form action="/transferencias" method="POST" id="formulario-transferencia">
                <div class="campo">
                    <label for="numero_cuenta_destino">Número de cuenta destino</label>
                    <input class="entrada" type="text" id="numero_cuenta_destino" name="numero_cuenta_destino" required>
                </div>

                <div class="campo">
                    <label for="valor">Valor a transferir</label>
                    <input class="entrada" type="number" id="valor" name="valor" step="0.01" min="0.01" required>
                </div>

                <button class="boton" id="boton-transferir" type="submit">Transferir</button>
            </form>

            <a class="enlace-volver" id="enlace-volver" href="/">Volver al panel</a>
        </section>
    </main>
</body>
</html>