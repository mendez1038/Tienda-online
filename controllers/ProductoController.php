<?php
require_once 'models/producto.php';

class ProductoController
{
    public function index()
    {
        $producto = new Producto();
        $products = $producto->getRandom(6);
        require_once 'views/product/destacados.php';
    }

    public function gestion()
    {
        Utils::isAdmin();
        $producto = new Producto();
        $products = $producto->getAll();
        require_once 'views/product/gestion.php';
    }

    /* --- CREAR (GET) --- */
    public function crear()
    {
        Utils::isAdmin();
        // Solo muestra el formulario vacío
        $edit = false;
        require_once 'views/product/crear.php';
    }

    /* --- GUARDAR (POST create) --- */
    public function guardar()
    {
        Utils::isAdmin();
        if (!$_POST) {
            header('Location: ' . base_url . 'producto/gestion');
            exit;
        }

        $nombre      = $_POST['nombre']      ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $precio      = $_POST['precio']      ?? '';
        $stock       = $_POST['stock']       ?? '';
        $categoria   = $_POST['categoria']   ?? '';
        $imagenFile  = $_FILES['imagen']     ?? null;

        if ($nombre && $descripcion && $precio !== '' && $stock !== '' && $categoria) {
            $p = new Producto();
            $p->setNombre($nombre);
            $p->setDescripcion($descripcion);
            $p->setPrecio($precio);
            $p->setStock($stock);
            $p->setCategoria_id($categoria);

            // Imagen (opcional)
            if ($imagenFile && !empty($imagenFile['name'])) {
                $filename = $imagenFile['name'];
                $mimetype = $imagenFile['type'];
                if (in_array($mimetype, ["image/jpg", "image/jpeg", "image/png", "image/gif"])) {
                    if (!is_dir('uploads/images')) {
                        mkdir('uploads/images', 0777, true);
                    }
                    move_uploaded_file($imagenFile['tmp_name'], 'uploads/images/' . $filename);
                    $p->setImagen($filename);
                }
            } else {
                $p->setImagen(null);
            }

            $ok = $p->save();
            $_SESSION['producto'] = $ok ? 'complete' : 'failed';
        } else {
            $_SESSION['producto'] = 'failed';
        }
        header('Location: ' . base_url . 'producto/gestion');
        exit;
    }

    /* --- EDITAR (GET) --- */
    public function edit()
    {
        Utils::isAdmin();
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($id <= 0) {
            header('Location: ' . base_url . 'producto/gestion');
            exit;
        }

        $producto = new Producto();
        $producto->setId($id);
        $pro = $producto->getOne();

        if (!$pro) {
            header('Location: ' . base_url . 'producto/gestion');
            exit;
        }

        $edit = true;
        require_once 'views/product/crear.php';
    }

    /* --- ACTUALIZAR (POST update) --- */
    public function update()
    {
        Utils::isAdmin();
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($id <= 0) {
            $_SESSION['producto'] = 'failed';
            header('Location: ' . base_url . 'producto/gestion');
            exit;
        }
        if (!$_POST) {
            header('Location: ' . base_url . 'producto/gestion');
            exit;
        }

        $nombre      = $_POST['nombre']      ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $precio      = $_POST['precio']      ?? '';
        $stock       = $_POST['stock']       ?? '';
        $categoria   = $_POST['categoria']   ?? '';
        $imagenFile  = $_FILES['imagen']     ?? null;

        if ($nombre && $descripcion && $precio !== '' && $stock !== '' && $categoria) {
            $p = new Producto();
            $p->setId($id);
            $p->setNombre($nombre);
            $p->setDescripcion($descripcion);
            $p->setPrecio($precio);
            $p->setStock($stock);
            $p->setCategoria_id($categoria);

            // Imagen nueva solo si se sube
            if ($imagenFile && !empty($imagenFile['name'])) {
                $filename = $imagenFile['name'];
                $mimetype = $imagenFile['type'];
                if (in_array($mimetype, ["image/jpg", "image/jpeg", "image/png", "image/gif"])) {
                    if (!is_dir('uploads/images')) {
                        mkdir('uploads/images', 0777, true);
                    }
                    move_uploaded_file($imagenFile['tmp_name'], 'uploads/images/' . $filename);
                    $p->setImagen($filename);
                }
            } else {
                $p->setImagen(null); // para que el modelo NO toque la imagen si no se manda
            }

            $ok = $p->update();
            $_SESSION['producto'] = $ok ? 'updated' : 'failed';
        } else {
            $_SESSION['producto'] = 'failed';
        }
        header('Location: ' . base_url . 'producto/gestion');
        exit;
    }

    public function delete()
    {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $p = new Producto();
            $p->setId((int)$_GET['id']);
            $_SESSION['delete'] = $p->delete() ? 'complete' : 'failed';
        } else {
            $_SESSION['delete'] = 'failed';
        }
        header('Location: ' . base_url . 'producto/gestion');
        exit;
    }

    public function ver()
    {
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $producto = new Producto();
            $producto->setId($id);
            $pro = $producto->getOne();
            require_once 'views/product/ver.php';
        } else {
            header('Location: ' . base_url);
            exit;
        }
    }
}
