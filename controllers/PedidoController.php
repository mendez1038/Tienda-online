<?php
require_once 'models/pedido.php';

class PedidoController
{
    public function hacer()
    {
        require_once 'views/pedido/pedido.php';
    }
    public function add()
    {
        if (!isset($_SESSION['identity'])) {
            header('Location: ' . base_url . 'carrito/index');
            exit;
        }
        if (empty($_SESSION['carrito']) || !is_array($_SESSION['carrito'])) {
            $_SESSION['pedido'] = 'failed';
            header('Location: ' . base_url . 'carrito/index');
            exit;
        }

        // total
        $total = 0.0;
        foreach ($_SESSION['carrito'] as $it) {
            $precio = (float)($it['precio'] ?? 0);
            $uds    = (int)($it['unidades'] ?? ($it['cantidad'] ?? 1));
            $total += $precio * max(1, $uds);
        }

        $p = new Pedido();
        $p->setUsuarioId($_SESSION['identity']->id);
        $p->setProvincia($_POST['provincia'] ?? '');
        $p->setLocalidad($_POST['localidad'] ?? '');
        $p->setDireccion($_POST['direccion'] ?? '');
        $p->setCoste($total);
        $p->setEstado('Pendiente');

        $conn = Database::connect();
        $conn->begin_transaction();
        $pedido_id = $p->save();
        $okLineas  = $pedido_id ? $p->saveLinea($pedido_id) : false;

        if ($pedido_id && $okLineas) {
            $conn->commit();
            $_SESSION['pedido'] = 'complete';
            unset($_SESSION['carrito']);
            header('Location: ' . base_url . 'pedido/confirmacion&id=' . $pedido_id);
            exit;
        } else {
            $conn->rollback();
            $_SESSION['pedido'] = 'failed';
            header('Location: ' . base_url . 'carrito/index');
            exit;
        }
    }


    public function confirmacion()
    {
        if (!isset($_SESSION['pedido']) || $_SESSION['pedido'] !== 'complete') {
            header('Location: ' . base_url . 'carrito/index');
            exit;
        }
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($id <= 0) {
            header('Location: ' . base_url);
            exit;
        }

        $pedidoModel = new Pedido();
        $pedido  = $pedidoModel->findById($id);
        $productos = $pedidoModel->getProductosByPedido($id);

        require_once 'views/pedido/confirmacion.php';
    }

    public function mis_pedidos()
    {
        Utils::isIdentity();
        $usuario_id = $_SESSION['identity']->id;
        $pedido = new Pedido();
        $pedido->setUsuarioId($usuario_id);
        $pedidos = $pedido->getPedidosByUserId();


        require_once 'views/pedido/mis_pedidos.php';
    }

    public function detalle()
    {
        Utils::isIdentity();
        if (!isset($_GET['id'])) {
            header('Location: ' . base_url . 'pedido/mis_pedidos');
            exit;
        }
        $id = (int)$_GET['id'];
        $pedidoModel = new Pedido();
        $pedidoModel->setId($id);
        $pedido = $pedidoModel->findById($id);

        $pedidoProductos = new Pedido();
        $productos = $pedidoProductos->getProductosByPedido($id);

        require_once 'views/pedido/detalle.php';
    }

    public function gestion()
    {
        Utils::isAdmin();
        $gestion = true;
        $pedido = new Pedido();
        $pedidos = $pedido->findAll();

        require_once 'views/pedido/mis_pedidos.php';
    }

    public function estado()
    {
        Utils::isAdmin();
        if (isset($_POST['pedido_id']) && isset($_POST['estado'])) {
            $pedido_id = (int)$_POST['pedido_id'];
            $estado    = $_POST['estado'];

            $pedido = new Pedido();
            $pedido->setId($pedido_id);
            $pedido->setEstado($estado);
            $pedido->updateEstado();
            header('Location: ' . base_url . 'pedido/detalle&id=' . $pedido_id);
        } else {
            header('Location: ' . base_url);
            exit;
        }
    }
}
