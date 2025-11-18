<!-- Contenido principal -->
<div class="central">
    <h1>Crear Nueva Categoría</h1>

    <form action="<?= base_url ?>categoria/save" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required>
        <input type="submit" value="Crear categoría">
    </form>
</div>