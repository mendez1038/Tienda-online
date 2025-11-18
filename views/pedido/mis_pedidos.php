<!-- Contenido principal -->
<div class="central mis-pedidos">
    <?php if (isset($gestion) && $gestion): ?>
        <h1>Gestión de Pedidos</h1>
    <?php endif; ?>
    <h1>Mis Pedidos</h1>
    <?php if (!empty($pedidos)): ?>
        <ul>
            <?php while ($pedido = $pedidos->fetch_object()): ?>
                <a href="<?= base_url ?>pedido/detalle&id=<?= $pedido->id; ?>">
                    <li class="pedido-item">
                        Pedido #<?= $pedido->id; ?> - <?= $pedido->coste; ?> € - <?= $pedido->fecha; ?> <?= $pedido->hora; ?> - Estado: <?= $pedido->estado; ?>
                    </li>
                </a>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No tienes pedidos realizados.</p>
    <?php endif; ?>
</div>