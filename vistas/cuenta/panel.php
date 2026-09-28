<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco ADSO - Mi cuenta</title>
    <link rel="stylesheet" href="/css/panel.css">
</head>
<body>
    <main class="tarjeta" id="tarjeta-panel">
        <header class="cabecera">
            <h1>Banco ADSO</h1>
            <p>Resumen de tu cuenta</p>
        </header>

        <section class="contenido">
            <p class="etiqueta-saldo">Saldo disponible</p>
            <p class="saldo" id="saldo">$<?= number_format($saldo, 2) ?></p>

            <nav class="menu" id="menu-panel">
                <a class="opcion" id="opcion-retirar" href="/retiros">Retirar dinero</a>
                <a class="opcion" id="opcion-transferir" href="/transferencias">Transferir dinero</a>
                <a class="opcion" id="opcion-historial-retiros" href="/retiros/historial">Historial de retiros</a>
                <a class="opcion" id="opcion-historial-transferencias" href="/transferencias/historial">Historial de transferencias</a>
            </nav>

            <form action="/salir" method="POST" id="formulario-cerrar-sesion">
                <button class="boton-secundario" id="boton-cerrar-sesion" type="submit">Cerrar sesión</button>
            </form>
        </section>
    </main>
</body>
</html>