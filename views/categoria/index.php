<!-- Contenido principal -->
<div class="central gestion-categorias">
    <h1>Gestionar Categorías</h1>

    <a href="<?= base_url ?>categoria/crear" class="button button-small-category">Crear Nueva Categoría</a>

    <?php while ($cat = $categorias->fetch_object()): ?>
        <div class="categoria-item">
            <h3><?php echo $cat->nombre; ?></h3>
            <a href="index.php?controller=categoria&action=delete&id=<?php echo $cat->id; ?>">Eliminar</a>
        </div>
    <?php endwhile; ?>
</div>