<?php
session_start();
require '../../config/config.php';

$investigador_id = trim($_POST['investigador_id']);
$titulo = $_POST['titulo'];
$anio = trim($_POST['anio']);
$autores = trim($_POST['autores']);
$editorial = trim($_POST['editorial']);
$pais = trim($_POST['pais']);
$tipo = trim($_POST['tipo']);
$numero_paginas = trim($_POST['numero_paginas']);

$sql = "INSERT INTO libros (investigador_id, titulo, anio, autores, editorial, pais, tipo, numero_paginas) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isssssss", $investigador_id, $titulo, $anio, $autores, $editorial, $pais, $tipo, $numero_paginas);
$stmt->execute();

header("Location: index.php");
exit();
?>