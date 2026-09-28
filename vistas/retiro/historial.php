<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco ADSO - Historial de retiros</title>
    <link rel="stylesheet" href="/css/retiro-historial.css">
</head>
<body>
    <main class="tarjeta" id="tarjeta-historial-retiros">
        <header class="cabecera">
            <h1>Historial de retiros</h1>
            <p>Todos los retiros hechos desde tu cuenta</p>
        </header>

        <section class="contenido">
            <?php if (empty($retiros)): ?>
                <p class="mensaje-vacio" id="sin-retiros">Aún no has realizado retiros.</p>
            <?php else: ?>
                <table class="tabla" id="tabla-retiros">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th class="columna-valor">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($retiros as $retiro): ?>
                            <tr>
                                <td><?= $retiro->getFecha()->format('d/m/Y H:i') ?></td>
                                <td class="columna-valor">$<?= number_format($retiro->getValor(), 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

            <a class="enlace-volver" id="enlace-volver" href="/">Volver al panel</a>
        </section>
    </main>
</body>
</html>