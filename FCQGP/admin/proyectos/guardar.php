<?php
session_start();
require '../../config/config.php';

$investigador_id = trim($_POST['investigador_id']);
$nombre = $_POST['nombre'];
$entidad_financiera = trim($_POST['entidad_financiera']);
$clave = trim($_POST['clave']);

$sql = "INSERT INTO proyectos (investigador_id, nombre, entidad_financiera, clave) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isss", $investigador_id, $nombre, $entidad_financiera, $clave);
$stmt->execute();

header("Location: index.php");
exit();
?>