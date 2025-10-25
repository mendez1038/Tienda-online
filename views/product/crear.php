<?php
// $edit boolean y $pro objeto cuando editas
if (isset($edit) && $edit && isset($pro) && is_object($pro)) {
    $titulo = "Editar Producto " . $pro->nombre;
    $url_action = base_url . "producto/update&id=" . (int)$pro->id; // <-- POST a update
} else {
    $titulo = "Crear Producto";
    $url_action = base_url . "producto/guardar"; // <-- POST a guardar
}
?>
<div class="central">
    <h1><?= $titulo ?></h1>

    <form action="<?= $url_action ?>" method="post" enctype="multipart/form-data">
        <label>Nombre</label>
        <input type="text" name="nombre" value="<?= isset($pro) ? htmlspecialchars($pro->nombre) : '' ?>" required>

        <label>Descripción</label>
        <textarea name="descripcion" required><?= isset($pro) ? htmlspecialchars($pro->descripcion) : '' ?></textarea>

        <label>Precio</label>
        <input type="number" step="0.01" name="precio" value="<?= isset($pro) ? $pro->precio : '' ?>" required>

        <label>Stock</label>
        <input type="number" name="stock" value="<?= isset($pro) ? (int)$pro->stock : '' ?>" required>

        <label>Categoría</label>
        <?php $categorias = Utils::showCategorias(); ?>
        <select name="categoria" required>
            <?php while ($cat = $categorias->fetch_object()): ?>
                <option value="<?= (int)$cat->id ?>" <?= (isset($pro) && $pro->categoria_id == $cat->id) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat->nombre) ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label>Imagen</label>
        <?php if (isset($pro) && $pro->imagen): ?>
            <img src="<?= base_url ?>uploads/images/<?= $pro->imagen ?>" class="thumb">
        <?php endif; ?>
        <input type="file" name="imagen">

        <input type="submit" value="Guardar" class="button button-small">
    </form>
</div>