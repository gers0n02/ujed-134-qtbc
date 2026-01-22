<?php
session_start();
require "../../config/config.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_POST['email'], $_POST['password'])) {
    header("Location: " . BASE_URL . "admin/login.php");
    exit();
}

$email = trim($_POST['email']);
$password = $_POST['password'];

$sql = "SELECT * FROM admin_users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $usuario = $result->fetch_assoc();

    if (password_verify($password, $usuario["password"])) {
        $_SESSION["admin_id"] = $usuario["id"];
        $_SESSION["admin_email"] = $usuario["email"];
        $_SESSION["admin_nombre"] = $usuario["nombre"];

        if ($usuario["debe_cambiar_pass"] == 1) {
            $_SESSION["force_change"] = true;
            header("Location: " . BASE_URL . "admin/configuracion/cambiar-credenciales.php");
            exit();
        }

        header("Location: " . BASE_URL . "admin/index.php");
        exit();
    } else {
        header("Location: " . BASE_URL . "admin/login.php?error-pass=1");
        exit();
    }
} else {
    header("Location: " . BASE_URL . "admin/login.php?error-email=1");
    exit();
}
?>