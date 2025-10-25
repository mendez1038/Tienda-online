<?php

class Pedido
{
    private $id;
    private $usuario_id;
    private $direccion;
    private $localidad;
    private $provincia;
    private $estado;
    private $fecha;
    private $hora;
    private $coste;
    private $db;

    public function __construct()
    {
        // Conexión a la base de datos
        $this->db = Database::connect();
    }

    // Getters y setters
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUsuarioId()
    {
        return $this->usuario_id;
    }

    public function setUsuarioId($usuario_id)
    {
        $this->usuario_id = $usuario_id;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    public function getLocalidad()
    {
        return $this->localidad;
    }

    public function setLocalidad($localidad)
    {
        $this->localidad = $this->db->real_escape_string($localidad);
    }

    public function getProvincia()
    {
        return $this->provincia;
    }

    public function setProvincia($provincia)
    {
        $this->provincia = $this->db->real_escape_string($provincia);
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $this->db->real_escape_string($estado);
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getCoste()
    {
        return $this->coste;
    }

    public function setCoste($v)
    {
        $v = str_replace(',', '.', (string)$v); // 19,99 -> 19.99
        $this->coste = (float)$v;
    }
    public function getHora()
    {
        return $this->hora;
    }

    public function setHora($hora)
    {
        $this->hora = $hora;
    }

    public function save(): int|false
    {
        $sql = "INSERT INTO pedidos (usuario_id, provincia, localidad, direccion, coste, estado, fecha, hora)
            VALUES (?, ?, ?, ?, ?, ?, CURDATE(), CURTIME())";
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            error_log('prep save: ' . $this->db->error);
            return false;
        }
        $estado = $this->estado ?: 'Pendiente';
        $stmt->bind_param('isssds', $this->usuario_id, $this->provincia, $this->localidad, $this->direccion, $this->coste, $estado);
        if (!$stmt->execute()) {
            error_log('exec save: ' . $stmt->error);
            $stmt->close();
            return false;
        }
        $id = $this->db->insert_id;
        $stmt->close();
        return $id;
    }

    public function saveLinea(int $pedido_id): bool
    {
        if (empty($_SESSION['carrito']) || !is_array($_SESSION['carrito'])) return false;
        $sql = "INSERT INTO lineas_pedidos (pedido_id, producto_id, unidades) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            error_log('prep lineas: ' . $this->db->error);
            return false;
        }

        foreach ($_SESSION['carrito'] as $item) {
            $producto_id = (int)($item['id_producto'] ?? 0);
            $unidades    = (int)($item['unidades'] ?? ($item['cantidad'] ?? 0));
            if ($producto_id <= 0 || $unidades <= 0) continue;

            $stmt->bind_param('iii', $pedido_id, $producto_id, $unidades);
            if (!$stmt->execute()) {
                error_log('exec lineas: ' . $stmt->error);
                $stmt->close();
                return false;
            }
        }
        $stmt->close();
        return true;
    }


    public function findAll()
    {
        $sql = "SELECT * FROM pedidos ORDER BY id DESC";
        $result = $this->db->query($sql);
        return $result;
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM pedidos WHERE id = $id";
        $result = $this->db->query($sql);
        return $result->fetch_object();
    }

    public function findByUserId()
    {
        $sql = " SELECT * FROM pedidos p "
            . " inner join lineas_pedidos lp on lp.pedido_id = p.id "
            . " WHERE p.usuario_id = {$this->getUsuarioId()} ORDER BY p.id DESC LIMIT 1 ";
        $result = $this->db->query($sql);
        return $result->fetch_object();
    }

    public function getProductosByPedido($id)
    {
        $id = (int)$id; // seguridad
        $sql = "SELECT pr.*, lp.unidades
            FROM lineas_pedidos lp
            INNER JOIN productos pr ON pr.id = lp.producto_id
            WHERE lp.pedido_id = $id
            ORDER BY lp.id ASC";
        return $this->db->query($sql);
    }

    public function getPedidosByUserId()
    {
        $sql = "SELECT * FROM pedidos WHERE usuario_id = {$this->getUsuarioId()} ORDER BY id DESC";
        $result = $this->db->query($sql);
        return $result;
    }

    public function updateEstado()
    {
        $sql = "UPDATE pedidos SET estado = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            error_log('prep updateEstado: ' . $this->db->error);
            return false;
        }
        $stmt->bind_param('si', $this->estado, $this->id);
        if (!$stmt->execute()) {
            error_log('exec updateEstado: ' . $stmt->error);
            $stmt->close();
            return false;
        }
        $stmt->close();
        return true;
    }
}
