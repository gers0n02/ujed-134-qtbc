<?php
session_start();
require "../../config/config.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

$id = $_SESSION['admin_id'];

$nombre = trim($_POST["nombre"]);
$email = trim($_POST["email"]);
$password = trim($_POST["password"]);

if ($password !== "") {
    $password = hash("sha256", $password);
    if ($email == "") {
        $sql = "UPDATE admin_users SET nombre = ?, password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $nombre, $password, $id);
    } else {
        $sql = "UPDATE admin_users SET nombre = ?, email = ?, password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nombre, $email, $password, $id);
    }
} else {
    if ($email == "") {
        $sql = "UPDATE admin_users SET nombre = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $nombre, $email, $id);
    } else {
        $sql = "UPDATE admin_users SET nombre = ?, email = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $nombre, $email, $id);
    }
}

$stmt->execute();

header("Location: index.php?success=1");
exit();
?>