<?php
require "../../config/config.php";
session_start();

if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit();
}

$id = $_GET["id"];

$sql = "UPDATE investigadores SET activo = 1 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php?restaurado=1");
    exit();
} else {
    echo "Error al restaurar.";
}
?>