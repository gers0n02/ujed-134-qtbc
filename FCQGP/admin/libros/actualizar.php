<?php
session_start();
require '../../config/config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

$id = (int) $_POST['id'];

$investigador_id = trim($_POST['investigador_id']);
$titulo = $_POST['titulo'];
$anio = trim($_POST['anio']);
$autores = trim($_POST['autores']);
$editorial = trim($_POST['editorial']);
$pais = trim($_POST['pais']);
$tipo = trim($_POST['tipo']);
$numero_paginas = trim($_POST['numero_paginas']);

$sql = "UPDATE libros SET investigador_id = ?, titulo = ?, anio = ?, autores = ?, editorial = ?, pais = ?, tipo = ?, numero_paginas = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isssssssi", $investigador_id, $titulo, $anio, $autores, $editorial, $pais, $tipo, $numero_paginas, $id);
$stmt->execute();

header("Location: index.php");
exit();
?>