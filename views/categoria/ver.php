<!-- Contenido principal -->
<div class="central">
    <?php if (isset($cat)): ?>
        <h1>Productos de la Categoría: <?= $cat->nombre ?></h1>
        <?php if ($productos && $productos->num_rows > 0): ?>
            <?php while ($producto = $productos->fetch_object()): ?>
                <div class="product">
                    <?php if ($producto->imagen): ?>
                        <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" alt="<?= $producto->nombre ?>">
                    <?php else: ?>
                        <img src="<?= base_url ?>img/logo.jpg" alt="Imagen por defecto">
                    <?php endif; ?>
                    <h2><?= $producto->nombre ?></h2>
                    <p class="price"><?= $producto->precio ?>€</p>
                    <a href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>" class="button">Ver Producto</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No hay productos disponibles en esta categoría.</p>
        <?php endif; ?>
    <?php else: ?>
        <h1>La categoría no existe.</h1>
    <?php endif; ?>
</div>