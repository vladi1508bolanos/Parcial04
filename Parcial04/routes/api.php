<?php

//archivo de rutas

// Archivo: routes/api.php

// Importar las clases de controladores

require_once __DIR__ . '/../controllers/StockController.php';
require_once __DIR__ . '/../controllers/AuthorController.php';
require_once __DIR__ . '/../controllers/GenreController.php';
require_once __DIR__ . '/../controllers/BookController.php';

// crear array de rutas

$routes = [
    // Rutas para 'Author'
    'authors' => [
        'index' => ['GET', 'AuthorController@index'],
        'show' => ['GET', 'AuthorController@show'], // Ruta para ver un autor específico
        'create' => ['GET', 'AuthorController@create'], // Ruta para mostrar el formulario de creación
        'store' => ['POST', 'AuthorController@store'], // Ruta para guardar un nuevo autor
        'edit' => ['GET', 'AuthorController@edit'], // Ruta para mostrar formulario de edición
        'update' => ['POST', 'AuthorController@update'], // Ruta para actualizar un autor
        'destroy' => ['POST', 'AuthorController@destroy'], // Ruta para eliminar un autor
    ],
    
    // Rutas para 'Book'
    'books' => [
        'index' => ['GET', 'BookController@index'],
        'create' => ['GET', 'BookController@create'],
        'store' => ['POST', 'BookController@store'],
        'edit' => ['GET', 'BookController@edit'],
        'update' => ['POST', 'BookController@update'],
        'destroy' => ['POST', 'BookController@destroy'],
        'combined' => ['GET', 'BookController@mostrarTodo'],
    ],

    // Rutas para 'Genre'
    'genres' => [
        'index' => ['GET', 'GenreController@index'],
        'create' => ['GET', 'GenreController@create'],
        'store' => ['POST', 'GenreController@store'],
        'edit' => ['GET', 'GenreController@edit'],
        'update' => ['POST', 'GenreController@update'],
        'destroy' => ['POST', 'GenreController@destroy'],
    ],

    // Rutas para 'Stock'
    'stocks' => [
        'index' => ['GET', 'StockController@index'],
        'create' => ['GET', 'StockController@create'],
        'store' => ['POST', 'StockController@store'],
        'edit' => ['GET', 'StockController@edit'],
        'update' => ['POST', 'StockController@update'],
        'destroy' => ['POST', 'StockController@destroy'],
    ]
];

// Procesar las rutas
function handleRequest($uri, $method) {
    global $routes;

    foreach ($routes as $key => $actions) {
        foreach ($actions as $action => $route) {
            if ("/{$key}/{$action}" == $uri && $route[0] == $method) {
                $controllerAction = explode('@', $route[1]);
                $controllerName = $controllerAction[0];
                $actionName = $controllerAction[1];

                // Llamar al controlador y acción correspondientes
                $controller = new $controllerName();
                $controller->$actionName();
                return;
            }
        }
    }

    // Si no se encuentra la ruta
    echo "Route not found.";
}

// Obtener la URI y el método HTTP
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// Manejar la solicitud
handleRequest($uri, $method);