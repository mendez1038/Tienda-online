<?php

class Producto
{
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;

    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    // Getters and setters...
    function setId($id)
    {
        $this->id = $id;
    }
    function getId()
    {
        return $this->id;
    }
    function setCategoria_id($categoria_id)
    {
        $this->categoria_id = $categoria_id;
    }
    function getCategoria_id()
    {
        return $this->categoria_id;
    }
    function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);
    }
    function getNombre()
    {
        return $this->nombre;
    }
    function setDescripcion($descripcion)
    {
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }
    function getDescripcion()
    {
        return $this->descripcion;
    }
    function setPrecio($precio)
    {
        $this->precio = (float)$precio;
    }
    function getPrecio()
    {
        return $this->precio;
    }
    function setStock($stock)
    {
        $this->stock  = (int)$stock;
    }
    function getStock()
    {
        return $this->stock;
    }
    function setOferta($oferta)
    {
        $this->oferta = $this->db->real_escape_string($oferta);
    }
    function getOferta()
    {
        return $this->oferta;
    }
    function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
    function getFecha()
    {
        return $this->fecha;
    }
    function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }
    function getImagen()
    {
        return $this->imagen;
    }


    public function getAll()
    {
        $sql = "SELECT * FROM productos ORDER BY id DESC";
        $result = $this->db->query($sql);
        return $result;
    }

    public function getOne()
    {
        $sql = "SELECT * FROM productos WHERE id = {$this->getId()}";
        $result = $this->db->query($sql);
        return $result->fetch_object();
    }

    // Other methods...
    public function save()
    {
        $sql = "INSERT INTO productos (categoria_id, nombre, descripcion, precio, stock, oferta, fecha, imagen) VALUES (
            {$this->getCategoria_id()},
            '{$this->getNombre()}',
            '{$this->getDescripcion()}',
            {$this->getPrecio()},
            {$this->getStock()},
            '{$this->getOferta()}',
            CURDATE(),
            '{$this->getImagen()}'
        )";
        $save = $this->db->query($sql);
        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function delete()
    {
        $sql = "DELETE FROM productos WHERE id = {$this->getId()}";
        $delete = $this->db->query($sql);
        $result = false;
        if ($delete) {
            $result = true;
        }
        return $result;
    }

    public function update()
    {
        $sql = "UPDATE productos SET 
                categoria_id = {$this->getCategoria_id()},
                nombre = '{$this->getNombre()}',
                descripcion = '{$this->getDescripcion()}',
                precio = {$this->getPrecio()},
                stock = {$this->getStock()}";

        if ($this->getImagen() != null) {
            $sql .= ", imagen = '{$this->getImagen()}'";
        }

        $sql .= " WHERE id = {$this->getId()}";

        $update = $this->db->query($sql);
        $result = false;
        if ($update) {
            $result = true;
        }
        return $result;
    }

    public function getRandom($limit)
    {
        $sql = "SELECT * FROM productos ORDER BY RAND() LIMIT $limit";
        $result = $this->db->query($sql);
        return $result;
    }

    public function getAllCategory()
    {
        $sql = "SELECT p.*, c.nombre as 'catnombre' FROM productos p INNER JOIN categorias c ON p.categoria_id = c.id WHERE p.categoria_id = {$this->getCategoria_id()} ORDER BY p.id DESC";
        $result = $this->db->query($sql);
        return $result;
    }
}
