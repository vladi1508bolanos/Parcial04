<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Proyecto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>

<?php

// Cargar configuraciones
require_once 'config/db.php';

// Instanciar la conexión a la base de datos
try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Sistema básico de enrutamiento
$routes = [
    '/' => function() use ($pdo) {
        require_once 'controllers/BookController.php';
        $controller = new BookController($pdo);
        $controller->index();
    },
    '/book' => function($id) use ($pdo) {
        require_once 'controllers/BookController.php';
        $controller = new BookController($pdo);
        $controller->show($id);
    },
];

// Obtener la URL solicitada y procesar
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request_method = $_SERVER['REQUEST_METHOD'];

if (isset($routes[$request_uri])) {
    $routes[$request_uri]();
} elseif (preg_match('/^\/book\/(\d+)$/', $request_uri, $matches)) {
    $routes['/book']($matches[1]);
} else {
    // Manejo de página no encontrada (404)
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 - Página no encontrada</h1>";
    echo "<p>La página que buscas no existe.</p>";
}

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>