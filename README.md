# Tienda Online (PHP MVC)

Tienda online desarrollada en **PHP puro** con patrón **MVC**, sesiones, carrito, pedidos, panel de administración y subida de imágenes.

## ✨ Funcionalidades
- Autenticación: registro, login, logout.
- Gestión de categorías y productos (CRUD).
- Subida de imágenes de producto.
- Carrito de compra (añadir, sumar, restar, eliminar).
- Creación de pedidos con líneas y confirmación.
- Roles: usuario y administrador.
- URL amigables con `.htaccess`.

## 🧱 Tech stack
- PHP >= 8.x (válido con 7.4+)
- MySQL / MariaDB
- Apache (mod_rewrite)
- WAMP/XAMPP/LAMP

## 📁 Estructura
/Tienda
├─ config/
│ ├─ database.php
│ └─ parameters.php
├─ controllers/
│ ├─ ProductoController.php
│ ├─ CategoriaController.php
│ ├─ UsuarioController.php
│ └─ PedidoController.php
├─ models/
│ ├─ producto.php
│ ├─ categoria.php
│ ├─ usuario.php
│ └─ pedido.php
├─ views/
│ ├─ layout/ (header.php, sidebar.php, footer.php)
│ ├─ producto/ (crear.php, gestion.php, destacados.php)
│ ├─ categoria/ (...)
│ ├─ usuario/ (...)
│ └─ pedido/ (confirmacion.php)
├─ uploads/
│ └─ images/ (imagenes de productos)
├─ helpers/ (utils.php)
├─ autoload.php
├─ index.php
└─ .htaccess


## ⚙️ Configuración
1. Clona el repo en el directorio público (ej. `C:\wamp64\www\Tienda`).
2. Crea la BD `tienda` e importa el dump (ver más abajo).
3. Edita `config/database.php`:
   ```php
   class Database{
     public static function connect(){
       $db = new mysqli('localhost','root','', 'tienda'); // ajusta pass si aplica
       $db->set_charset('utf8mb4');
       return $db;
     }
   }
4.Edita config/parameters.php:
define('base_url', 'http://localhost/Tienda/'); // o /tienda/ según tu carpeta
define('controller_default','ProductoController');
define('action_default','index');
