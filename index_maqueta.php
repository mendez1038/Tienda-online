<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <title>Tienda de Vinos</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container">
        <!-- Cabecera -->
        <header class="header">
            <div class="logo">
                <img src="img/logo.jpg" alt="Logo de la tienda">
                <a href="index.php">Tienda de vinos</a>
            </div>
        </header>


        <!-- Menú -->
        <nav class="menu">
            <ul>
                <li>
                    <a href="#">Inicio</a>
                </li>
                <li>
                    <a href="#">Categoria 1</a>
                </li>
                <li>
                    <a href="#">Categoria 2</a>
                </li>
                <li>
                    <a href="#">Categoria 3</a>
                </li>
                <li>
                    <a href="#">Categoria 4</a>
                </li>
            </ul>
        </nav>
        <div class="content">
            <!-- barra lateral -->
            <aside class="sidebar">
                <div class="login block-aside">
                    <h3>Iniciar sesión</h3>
                    <form action="#" method="post">
                        <label for="email">Email</label>
                        <input type="email" name="email" required>
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" required>
                        <input type="submit" value="Iniciar sesión">
                    </form>
                    <ul>
                        <li><a href="#">Mis pedidos</a></li>
                        <li><a href="#">Gestionar Pedidos</a></li>
                        <li><a href="#">Gestionar Categorías</a></li>
                    </ul>

                </div>
            </aside>
            <!-- Contenido principal -->
            <div class="central">
                <h1>Productos Destacados</h1>
                <div class="product">
                    <img src="img/logo.jpg" alt="Vino">
                    <h2>Vino Tinto</h2>
                    <p>Descripción del vino. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Quisque sit amet accumsan arcu. Sed vitae nisi eget tellus tincidunt tincidunt.
                        Nulla facilisi.</p>
                    <p class="price">20.00€</p>
                    <a href="#" class="button">Comprar</a>
                </div>
                <div class="product">
                    <img src="img/logo.jpg" alt="Vino">
                    <h2>Vino Tinto</h2>
                    <p>Descripción del vino. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Quisque sit amet accumsan arcu. Sed vitae nisi eget tellus tincidunt tincidunt.
                        Nulla facilisi.</p>
                    <p class="price">20.00€</p>
                    <a href="#" class="button">Comprar</a>
                </div>
                <div class="product">
                    <img src="img/logo.jpg" alt="Vino">
                    <h2>Vino Tinto</h2>
                    <p>Descripción del vino. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Quisque sit amet accumsan arcu. Sed vitae nisi eget tellus tincidunt tincidunt.
                        Nulla facilisi.</p>
                    <p class="price">20.00€</p>
                    <a href="#" class="button">Comprar</a>
                </div>
                <div class="product">
                    <img src="img/logo.jpg" alt="Vino">
                    <h2>Vino Tinto</h2>
                    <p>Descripción del vino. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Quisque sit amet accumsan arcu. Sed vitae nisi eget tellus tincidunt tincidunt.
                        Nulla facilisi.</p>
                    <p class="price">20.00€</p>
                    <a href="#" class="button">Comprar</a>
                </div>
            </div>

        </div>


        <!-- Pie de página -->
        <footer class="footer">
            <p>Desarrollado por David Méndez &copy; <?= date('Y') ?></p>
        </footer>
    </div>
</body>

</html>