<?php
session_start();
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';

function show_error()
{
    $error = new errorController();
    $error->index();
}

if (isset($_GET['controller'])) {
    $nombre_controlador = $_GET['controller'] . 'Controller';
} else {
    $nombre_controlador = controller_default;
}

if (class_exists($nombre_controlador)) {
    $controlador = new $nombre_controlador();
    if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
        $action = $_GET['action'];
        // Construir lista de parámetros opcionales
        $paramList = [];

        // Soporta /categoria/delete&id=7
        if (isset($_GET['id'])) {
            $paramList[] = (int) $_GET['id'];
        }

        // Soporta /categoria/delete/7 si usas regla que ponga ?params=7
        if (!empty($_GET['params'])) {
            $extra = array_values(array_filter(explode('/', trim($_GET['params'], '/'))));
            // normaliza a enteros si son ids
            $extra = array_map(fn($x) => ctype_digit($x) ? (int)$x : $x, $extra);
            $paramList = array_merge($paramList, $extra);
        }

        call_user_func_array([$controlador, $action], $paramList);
    } else {
        $action_default = action_default;
        $controlador->$action_default();
    }
} else {
    show_error();
}

require_once 'views/layout/footer.php';
