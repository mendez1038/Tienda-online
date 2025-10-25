<?php
require_once 'models/categoria.php';
require_once 'models/producto.php';
class CategoriaController
{
    public function index()
    {
        // Lógica para mostrar la lista de categorias
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getCategorias();
        require_once 'views/categoria/index.php';
    }


    public function crear()
    {
        // Lógica para crear una nueva categoría
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }

    public function save()
    {
        // Lógica para almacenar una nueva categoría
        Utils::isAdmin();
        if (isset($_POST['nombre'])) {
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']);
            // Aquí deberías agregar la lógica para guardar la categoría en la base de datos
            // Por ejemplo:
            $save = $categoria->save();
            if ($save) {
                $_SESSION['categoria'] = "complete";
            } else {
                $_SESSION['categoria'] = "failed";
            }
        } else {
            $_SESSION['categoria'] = "failed";
        }
        header("Location:" . base_url . "categoria/index");
    }

    public function delete($id = null)
    {
        if ($id === null && isset($_GET['id'])) {
            $id = (int) $_GET['id'];
        }
        $id = (int) $id;

        if ($id <= 0) {
            show_error();
            return;
        }
        // Lógica para eliminar una categoría existente
        Utils::isAdmin();
        if ($id) {
            $categoria = new Categoria();
            $categoria->setId($id);
            $delete = $categoria->delete();
            if ($delete) {
                $_SESSION['delete'] = 'complete';
            } else {
                $_SESSION['delete'] = 'failed';
            }
        } else {
            $_SESSION['delete'] = 'failed';
        }
        header("Location:" . base_url . "categoria/index");
    }

    public function ver()
    {
        if (isset($_GET['id'])) {
            $id = (int) $_GET['id'];

            // Conseguir categoria
            $categoria = new Categoria();
            $categoria->setId($id);
            $cat = $categoria->getOne();

            // Conseguir productos
            $producto = new Producto();
            $producto->setCategoria_id($id);
            $productos = $producto->getAllCategory();
        }

        require_once 'views/categoria/ver.php';
    }
}
