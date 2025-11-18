<!-- Contenido principal -->
<div class="central detalle-pedido">
    <h1>Detalle del Pedido</h1>
    <?php if (isset($_SESSION['admin'])): ?>
        <a href="<?= base_url ?>pedido/gestion" class="button button-small-category">Volver a Gestión de Pedidos</a>
        <h2>Cambiar Estado</h2>
        <form action="<?= base_url ?>pedido/estado" method="post">
            <input type="hidden" name="pedido_id" value="<?= $pedido->id; ?>">
            <select name="estado">
                <option value="Pendiente" <?= $pedido->estado == 'Pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                <option value="En preparación" <?= $pedido->estado == 'En preparación' ? 'selected' : ''; ?>>En preparación</option>
                <option value="Enviado" <?= $pedido->estado == 'Enviado' ? 'selected' : ''; ?>>Enviado</option>
                <option value="Entregado" <?= $pedido->estado == 'Entregado' ? 'selected' : ''; ?>>Entregado</option>
            </select>
            <input type="submit" value="Actualizar Estado" class="button button-small-category">
        </form>
    <?php endif; ?>
    <p>ID del Pedido: <?= $pedido->id; ?></p>
    <p>Estado: <?= $pedido->estado; ?></p>
    <h2>Productos</h2>
    <ul>
        <?php while ($producto = $productos->fetch_object()): ?>
            <li><?= $producto->nombre; ?> - <?= $producto->unidades; ?> x <?= $producto->precio; ?>€</li>
        <?php endwhile; ?>
    </ul>
    <p>Total: <?= $pedido->coste; ?>€</p>
</div>