<?php

// Archivo: config/db.php

// Configuración de la base de datos
$host = '127.0.0.1'; // Dirección del servidor MySQL
$dbname = 'libraryDB'; // Nombre de la base de datos
$username = 'root'; // Usuario de la base de datos
$password = ''; // Contraseña de la base de datos (vacío si no tienes una)

$dsn = "mysql:host={$host};dbname={$dbname}"; // Construir la cadena DSN

try {
    // Crear la conexión PDO
    $pdo = new PDO($dsn, $username, $password);
    
    // Establecer el modo de error para excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Mostrar el mensaje de éxito como una alerta
    echo '<div id="success-alert" class="alert alert-success" role="alert">
            Conexión exitosa a la base de datos.
          </div>';
    echo '<script>
            setTimeout(function() {
                var alert = document.getElementById("success-alert");
                alert.style.display = "none";
            }, 3000);
          </script>';
} catch (PDOException $e) {
    // Si hay un error en la conexión, mostrar el mensaje
    echo 'Connection failed: ' . $e->getMessage();
}