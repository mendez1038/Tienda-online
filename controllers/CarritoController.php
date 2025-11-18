<?php
require_once 'models/producto.php';

class CarritoController
{
    public function index()
    {
        // Lógica para mostrar el carrito de compras
        $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : array();
        require_once 'views/carrito/index.php';
    }

    public function agregarAlCarrito()
    {
        // Validar id
        if (!isset($_GET['id'])) {
            header("Location: " . base_url);
            return;
        }
        $productoId = (int)$_GET['id'];

        // Asegura que el carrito es un array
        if (!isset($_SESSION['carrito']) || !is_array($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        // Si ya existe el producto, suma unidades
        $encontrado = false;
        foreach ($_SESSION['carrito'] as $i => $item) {
            if (isset($item['id_producto']) && (int)$item['id_producto'] === $productoId) {
                $_SESSION['carrito'][$i]['unidades']++;
                $encontrado = true;
                break;
            }
        }

        // Si no estaba, lo añadimos
        if (!$encontrado) {
            $p = new Producto();
            $p->setId($productoId);
            $p = $p->getOne(); // objeto producto

            if (is_object($p)) {
                $_SESSION['carrito'][] = [
                    'id_producto' => (int)$p->id,
                    'precio'      => (float)$p->precio,
                    'unidades'    => 1,
                    'producto'    => $p, // guardas el objeto para mostrar rápido
                ];
            }
        }

        header("Location: " . base_url . "carrito/index");
    }

    public function eliminarDelCarrito($productoId)
    {
        // Lógica para eliminar un producto del carrito
        if (isset($_SESSION['carrito']) && is_array($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $i => $item) {
                if (isset($item['id_producto']) && (int)$item['id_producto'] === (int)$productoId) {
                    unset($_SESSION['carrito'][$i]);
                    // Reindexar el array
                    $_SESSION['carrito'] = array_values($_SESSION['carrito']);
                    header("Location: " . base_url . "carrito/index");
                    break;
                }
            }
        }
    }

    public function mostrarCarrito()
    {
        // Lógica para mostrar el contenido del carrito
    }

    public function vaciarCarrito()
    {
        // Lógica para vaciar el carrito
        unset($_SESSION['carrito']);
        header("Location: " . base_url . "carrito/index");
    }

    public function actualizarCantidad()
    {
        // Lógica para actualizar la cantidad de un producto en el carrito
        if (isset($_GET['id']) && isset($_GET['cantidad'])) {
            $productoId = (int)$_GET['id'];
            $nuevaCantidad = (int)$_GET['cantidad'];

            if (isset($_SESSION['carrito']) && is_array($_SESSION['carrito'])) {
                foreach ($_SESSION['carrito'] as $i => $item) {
                    if (isset($item['id_producto']) && (int)$item['id_producto'] === $productoId) {
                        if ($nuevaCantidad > 0) {
                            $_SESSION['carrito'][$i]['unidades'] = $nuevaCantidad;
                        } else {
                            // Si la cantidad es 0 o menor, eliminar el producto del carrito
                            unset($_SESSION['carrito'][$i]);
                            // Reindexar el array
                            $_SESSION['carrito'] = array_values($_SESSION['carrito']);
                        }
                        break;
                    }
                }
            }
        }
        header("Location: " . base_url . "carrito/index");
    }
}
