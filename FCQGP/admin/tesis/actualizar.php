<?php
session_start();
require '../../config/config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

$id = (int) $_POST['id'];

$investigador_id = trim($_POST['investigador_id']);
$grado_academico = $_POST['grado_academico'];
$nombre_alumno = trim($_POST['nombre_alumno']);
$nombre_tesis = trim($_POST['nombre_tesis']);
$anio_terminacion = trim($_POST['anio_terminacion']);

$sql = "UPDATE tesis SET investigador_id = ?, grado_academico = ?, nombre_alumno = ?, nombre_tesis = ?, anio_terminacion = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("issssi", $investigador_id, $grado_academico, $nombre_alumno, $nombre_tesis, $anio_terminacion, $id);
$stmt->execute();

header("Location: index.php");
exit();
?>