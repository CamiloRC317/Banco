<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco ADSO - Historial de transferencias</title>
    <link rel="stylesheet" href="/css/transferencia-historial.css">
</head>
<body>
    <main class="tarjeta" id="tarjeta-historial-transferencias">
        <header class="cabecera">
            <h1>Historial de transferencias</h1>
            <p>Las que enviaste y las que recibiste</p>
        </header>

        <section class="contenido">
            <?php if (empty($transferencias)): ?>
                <p class="mensaje-vacio" id="sin-transferencias">Aún no tienes transferencias.</p>
            <?php else: ?>
                <table class="tabla" id="tabla-transferencias">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Tipo</th>
                            <th class="columna-valor">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transferencias as $transferencia): ?>
                            <tr>
                                <td><?= $transferencia->getFecha()->format('d/m/Y H:i') ?></td>
                                <td>
                                    <?php if ($transferencia->getCuentaOrigen() === $cuenta_id): ?>
                                        <span class="etiqueta enviada">Enviada</span>
                                    <?php else: ?>
                                        <span class="etiqueta recibida">Recibida</span>
                                    <?php endif; ?>
                                </td>
                                <td class="columna-valor">$<?= number_format($transferencia->getValor(), 2) ?></td>
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