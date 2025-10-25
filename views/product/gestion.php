<!-- Contenido principal -->
<div class="central">
    <h1>Gestión de Productos</h1>

    <?php if (isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'): ?>
        <strong class="alert_green">El producto se ha creado correctamente</strong>
    <?php elseif (isset($_SESSION['producto']) && $_SESSION['producto'] == 'failed'): ?>
        <strong class="alert_red">Fallo al crear el producto</strong>
    <?php endif; ?>
    <?php Utils::deleteSession('producto'); ?>
    <?php if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): ?>
        <strong class="alert_green">El producto se ha eliminado correctamente</strong>
    <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'failed'): ?>
        <strong class="alert_red">Fallo al eliminar el producto</strong>
    <?php endif; ?>
    <?php Utils::deleteSession('delete'); ?>
    <a href="<?= base_url ?>producto/crear" class="button button-small-category crear">Crear Producto</a>
    <?php if (isset($products) && $products && $products->num_rows > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
            <?php while ($product = $products->fetch_object()): ?>
                <tr>
                    <td><?= $product->id ?></td>
                    <td><?= $product->nombre ?></td>
                    <td>$<?= $product->precio ?></td>
                    <td><?= $product->stock ?></td>
                    <td>
                        <a href="<?= base_url ?>producto/edit&id=<?= $product->id ?>" class="button button-gestion">Editar</a>
                        <a href="<?= base_url ?>producto/delete&id=<?= $product->id ?>" class="button button-gestion button-red">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No hay productos aún.</p>
    <?php endif; ?>
</div>