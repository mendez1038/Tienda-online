<!-- Contenido principal -->
<div class="central confirmacion">
    <?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] === "complete"): ?>
        <h1>Confirmación de Pedido</h1>
        <p>Gracias por su compra. Su pedido ha sido confirmado.</p>

        <?php if (!empty($pedido)): ?>
            <h3>Detalles del Pedido:</h3>
            <p>Número de Pedido: <?= (int)$pedido->id; ?></p>
            <p>Total a Pagar: €<?= number_format((float)($pedido->coste ?? 0), 2) ?></p>
            <p>Dirección de Envío:
                <?= htmlspecialchars($pedido->direccion ?? '') ?>,
                <?= htmlspecialchars($pedido->localidad ?? '') ?>,
                <?= htmlspecialchars($pedido->provincia ?? '') ?>
            </p>

            <h3>Productos:</h3>
            <?php if ($productos && $productos->num_rows > 0): ?>
                <ul>
                    <?php while ($row = $productos->fetch_object()): ?>
                        <li><?= htmlspecialchars($row->nombre) ?> — €<?= number_format((float)$row->precio, 2) ?> (<?= (int)$row->unidades ?>)</li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>No hay líneas en este pedido.</p>
            <?php endif; ?>

        <?php endif; ?>

    <?php else: ?>
        <h1>Pedido No Confirmado</h1>
        <p>Lo sentimos, pero no hemos podido confirmar su pedido.</p>
    <?php endif; ?>
</div>