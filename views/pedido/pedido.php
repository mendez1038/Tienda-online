<!-- Contenido principal -->
<div class="central">
    <?php if (isset($_SESSION['identity'])) : ?>
        <h1>Hacer pedido</h1>
        <a href="<?= base_url ?>carrito/index.php" class="button pedido button-small-category">Volver al carrito</a>

        <form action="<?= base_url ?>pedido/add" method="POST">
            <h3>Dirección de envío</h3>
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" placeholder="Dirección" required>
            <label for="localidad">Localidad:</label>
            <input type="text" id="localidad" name="localidad" placeholder="Localidad" required>
            <label for="provincia">Provincia:</label>
            <input type="text" id="provincia" name="provincia" placeholder="Provincia" required>

            <h3>Método de pago</h3>
            <label for="metodo_pago">Selecciona un método de pago:</label>
            <select id="metodo_pago" name="metodo_pago" required>
                <option value="tarjeta">Tarjeta de crédito/débito</option>
                <option value="paypal">PayPal</option>
                <option value="transferencia">Transferencia bancaria</option>
            </select>

            <button type="submit" class="button button-small-category pedido">Realizar pedido</button>
        </form>
    <?php else : ?>

        <h1>Necesitas estar identificado</h1>
        <p>Debes iniciar sesión o registrarte para poder realizar tu pedido.</p>
        <a href="<?= base_url ?>usuario/registro" class="button button-small-category pedido">Registrarse</a>
    <?php endif; ?>

</div>