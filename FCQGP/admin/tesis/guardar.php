<?php
session_start();
require '../../config/config.php';

$investigador_id = trim($_POST['investigador_id']);
$grado_academico = $_POST['grado_academico'];
$nombre_alumno = trim($_POST['nombre_alumno']);
$nombre_tesis = trim($_POST['nombre_tesis']);
$anio_terminacion = trim($_POST['anio_terminacion']);

$sql = "INSERT INTO tesis (investigador_id, grado_academico, nombre_alumno, nombre_tesis, anio_terminacion) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("issss", $investigador_id, $grado_academico, $nombre_alumno, $nombre_tesis, $anio_terminacion);
$stmt->execute();

header("Location: index.php");
exit();
?>