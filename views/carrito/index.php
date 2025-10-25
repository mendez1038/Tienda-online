<?php $carrito = isset($_SESSION['carrito']) && is_array($_SESSION['carrito']) ? $_SESSION['carrito'] : []; ?>
<!-- Contenido principal -->
<div class="central">
    <h1>Carrito de la compra</h1>
    <div class="cart">
        <?php if (count($carrito)): ?>
            <?php foreach ($carrito as $elemento): ?>
                <?php if (is_array($elemento) && isset($elemento['producto'])):
                    $producto = $elemento['producto']; ?>
                    <div class="producto">
                        <h2><?= htmlspecialchars($producto->nombre) ?></h2>
                        <p>Precio: <?= number_format($producto->precio, 2) ?> €</p>
                        <p>Cantidad: <?= (int)$elemento['unidades'] ?></p>
                        <div class="cantidad">
                            <!-- Aquí podrías agregar botones para aumentar/disminuir cantidad si lo deseas -->
                            <a href="<?= base_url ?>carrito/actualizarCantidad&id=<?= $producto->id ?>&cantidad=<?= (int)$elemento['unidades'] + 1 ?>" class="button aumentar">+</a>
                            <a href="<?= base_url ?>carrito/actualizarCantidad&id=<?= $producto->id ?>&cantidad=<?= (int)$elemento['unidades'] - 1 ?>" class="button disminuir">-</a>
                        </div>
                        <a href="<?= base_url ?>carrito/eliminarDelCarrito&id=<?= $producto->id ?>" class="button eliminar">Eliminar</a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <div class="total">
                <?php
                $total = 0;
                foreach ($carrito as $elemento) {
                    if (is_array($elemento) && isset($elemento['precio']) && isset($elemento['unidades'])) {
                        $total += $elemento['precio'] * $elemento['unidades'];
                    }
                }
                ?>
                <h3>Total: <?= number_format($total, 2) ?> €</h3>
                <a href="<?= base_url ?>pedido/hacer" class="button checkout">Proceder a la compra</a>
                <a href="<?= base_url ?>carrito/vaciarCarrito" class="button clear">Vaciar carrito</a>
            </div>
        <?php else: ?>
            <p>No hay productos en el carrito.</p>
        <?php endif; ?>

    </div>