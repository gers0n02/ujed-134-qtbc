<?php
session_start();
require '../../config/config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

$id = (int) $_POST['id'];

$investigador_id = trim($_POST['investigador_id']);
$nombre = $_POST['nombre'];
$entidad_financiera = trim($_POST['entidad_financiera']);
$clave = trim($_POST['clave']);

$sql = "UPDATE proyectos SET investigador_id = ?, nombre = ?, entidad_financiera = ?, clave = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isssi", $investigador_id, $nombre, $entidad_financiera, $clave, $id);
$stmt->execute();

header("Location: index.php");
exit();
?>