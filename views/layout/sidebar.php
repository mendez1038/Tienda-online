<!-- barra lateral -->
<aside class="sidebar">
    <div class="carrito block-aside">
        <h3>Mi carrito</h3>
        <a href="<?= base_url ?>carrito/index">
            <?php $stats = Utils::statsCarrito(); ?>
            <span class="material-symbols-outlined">Ver el carrito (<?= $stats['count'] ?>)</span>
            <!-- <span class="cantidad-carrito"><?= $stats['count'] ?> productos</span>-->
            <!-- <span class="total-carrito"><?= number_format($stats['total'], 2) ?> €</span>-->
        </a>
    </div>
    <div class="login block-aside">

        <?php if (!isset($_SESSION['identity'])) : ?>
            <h3>Iniciar sesión</h3>
            <form action="<?= base_url ?>usuario/login" method="post">
                <label for="email">Email</label>
                <input type="email" name="email" required>
                <label for="password">Contraseña</label>
                <input type="password" name="password" required>
                <input type="submit" class="button button-small-category" value="Iniciar sesión">
            </form>
            <a href="<?= base_url ?>usuario/registro" class="button button-small-category">Crear cuenta</a>
        <?php else : ?>
            <h3><?= $_SESSION['identity']->nombre . ' ' . $_SESSION['identity']->apellidos; ?></h3>
            <?php if (isset($_SESSION['admin'])) : ?>
                <a href="<?= base_url ?>categoria/index" class="button button-small-category">Gestionar Categorías</a>
                <a href="<?= base_url ?>producto/gestion" class="button button-small-category">Gestionar Productos</a>
                <a href="<?= base_url ?>pedido/gestion" class="button button-small-category">Gestionar Pedidos</a>
            <?php endif; ?>
            <a href="<?= base_url ?>pedido/mis_pedidos" class="button button-small-category">Mis pedidos</a>
            <a href="<?= base_url ?>usuario/logout" class="button button-small-category">Cerrar sesión</a>

        <?php endif; ?>

    </div>
</aside>