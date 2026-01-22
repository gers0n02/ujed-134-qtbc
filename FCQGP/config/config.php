<?php
// url base
define('BASE_URL', '/fcqgp/');

// configuración de la conexión
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'fcqgp_db';

// creación de la conexión
$conn = new mysqli($host, $user, $pass, $db);

// verificación de la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>