<?php
session_start();
require '../../config/config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = intval($_GET['id']);

$sqlDelete = "UPDATE investigadores SET activo = 0 WHERE id = ?";
$stmt = $conn->prepare($sqlDelete);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php?eliminado=1");
    exit();
} else {
    echo "Error al eliminar";
}
?>