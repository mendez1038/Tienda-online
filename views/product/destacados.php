<!-- Contenido principal -->
<div class="central">
    <h1>Productos Destacados</h1>
    <?php if ($products && $products->num_rows > 0): ?>
        <?php while ($product = $products->fetch_object()): ?>
            <div class="product">
                <?php if ($product->imagen): ?>
                    <img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>" alt="<?= $product->nombre ?>">
                <?php else: ?>
                    <img src="<?= base_url ?>img/logo.jpg" alt="Imagen por defecto">
                <?php endif; ?>
                <h2><?= $product->nombre ?></h2>
                <p class="price"><?= $product->precio ?>€</p>
                <a href="<?= base_url ?>producto/ver&id=<?= $product->id ?>" class="button">Ver Producto</a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No hay productos destacados disponibles.</p>
    <?php endif; ?>
</div>