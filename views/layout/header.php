<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <title>Tienda de Vinos</title>
    <!-- Clave para que los assets funcionen desde /usuario/registro, /categoria/listar, etc -->
    <base href="<?= base_url ?>">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container">
        <!-- Cabecera -->
        <header class="header">
            <div class="logo">
                <img src="img/logo.jpg" alt="Logo de la tienda">
                <a href="<?= base_url ?>">Tienda de vinos</a>
            </div>
        </header>

        <!-- Menú -->
        <?php $categorias = Utils::showCategorias(); ?>
        <nav class="menu">
            <ul>
                <li>
                    <a href="<?= base_url ?>">Inicio</a>
                </li>
                <?php while ($cat = $categorias->fetch_object()) : ?>
                    <li>
                        <a href="<?= base_url ?>categoria/ver&id=<?= $cat->id ?>"><?= $cat->nombre; ?></a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </nav>
        <div class="content">