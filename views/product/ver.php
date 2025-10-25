<!-- Contenido principal -->
<div class="central">
    <?php if (isset($pro)): ?>
        <h1><?= $pro->nombre ?></h1>
        <div class="product-detail">
            <?php if ($pro->imagen): ?>
                <img src="<?= base_url ?>uploads/images/<?= $pro->imagen ?>" alt="<?= $pro->nombre ?>">
            <?php else: ?>
                <img src="<?= base_url ?>img/logo.jpg" alt="Imagen por defecto">
            <?php endif; ?>
            <div class="product-info">
                <p class="price"><?= $pro->precio ?>€</p>
                <p class="description"><?= $pro->descripcion ?></p>


                <a href="<?= base_url ?>carrito/agregarAlCarrito&id=<?= $pro->id ?>" class="button button-small-category">Comprar</a>
            </div>
        </div>
    <?php else: ?>
        <h1>El producto no existe</h1>
    <?php endif; ?>
</div>