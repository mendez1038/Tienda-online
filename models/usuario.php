<?php
require_once 'config/db.php';

class Usuario
{
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $imagen;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    function getId()
    {
        return $this->id;
    }
    function getNombre()
    {
        return $this->db->real_escape_string($this->nombre);
    }
    function getApellidos()
    {
        return $this->db->real_escape_string($this->apellidos);
    }
    function getEmail()
    {
        return $this->db->real_escape_string($this->email);
    }
    function getPassword()
    {
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
    }
    function getRol()
    {
        return $this->rol;
    }
    function getImagen()
    {
        return $this->imagen;
    }
    function setId($id)
    {
        $this->id = $id;
    }
    function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);
    }
    function setApellidos($apellidos)
    {
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }
    function setEmail($email)
    {
        $this->email = $this->db->real_escape_string($email);
    }
    function setPassword($password)
    {
        $this->password =  $password;
    }
    function setRol($rol)
    {
        $this->rol = $rol;
    }
    function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function save()
    {
        $sql = "INSERT INTO usuarios (nombre, apellidos, email, password, rol, imagen)
            VALUES (?, ?, ?, ?, 'user', NULL)";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) return false;

        $nombre = $this->nombre;
        $apellidos = $this->apellidos;
        $email = $this->email;
        $hash = password_hash($this->password, PASSWORD_BCRYPT);

        $stmt->bind_param('ssss', $nombre, $apellidos, $email, $hash);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }


    public function login()
    {
        $sql = "SELECT * FROM usuarios WHERE email = ? LIMIT 1";
        $stmt = $this->db->prepare($sql);
        if (!$stmt) return false;
        $email = $this->email;
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $usuario = $result->fetch_object();
            $storedHashOrPlain = $usuario->password;
            $password = $this->password;

            // 1) Si está hasheada (password_verify)
            if (password_verify($password, $storedHashOrPlain)) {
                $stmt->close();
                return $usuario;
            }

            // 2) Si no, comprobar igualdad directa (plaintext stored)
            if (hash_equals($storedHashOrPlain, $password)) {
                // Migrar: re-hashear y actualizar en la BD
                $newHash = password_hash($password, PASSWORD_BCRYPT);
                $updateSql = "UPDATE usuarios SET password = ? WHERE id = ?";
                $upd = $this->db->prepare($updateSql);
                if ($upd) {
                    $upd->bind_param('si', $newHash, $usuario->id);
                    $upd->execute();
                    $upd->close();
                }
                $stmt->close();
                // devuelve el usuario (ya autenticado)
                return $usuario;
            }
        }
        $stmt->close();
        return false;
    }
}
