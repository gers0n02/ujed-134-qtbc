<?php
session_start();
require "../../config/config.php";

if (!isset($_SESSION["admin_id"]) || !isset($_SESSION["force_change"]) || $_SESSION["force_change"] !== true) {
    header("Location: " . BASE_URL . "admin/index.php");
    exit();
}

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nueva_pass = trim($_POST["password"]);
    $patron = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d]).{8,}$/";

    if (!preg_match($patron, $nueva_pass)) {
        $mensaje = "La contraseña debe tener: mínimo 8 caracteres, mayúscula, minúscula, número y símbolo.";
    } else {
        $hash = password_hash($nueva_pass, PASSWORD_DEFAULT);

        $id = $_SESSION["admin_id"];

        $sql = "UPDATE admin_users SET password = ?, debe_cambiar_pass = 0 WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $hash, $id);
        $stmt->execute();

        $_SESSION["force_change"] = false;
        unset($_SESSION["force_change"]);

        $mensaje = "¡Credenciales actualizadas! Inicia sesión nuevamente.";
        session_unset();
        session_destroy();

        header("Location: " . BASE_URL . "admin/login.php?changed=1");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar credenciales</title>

    <link rel="preload" href="<?php echo BASE_URL; ?>assets/css/normalize.css" as="style">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/normalize.css">

    <link rel="preload" href="<?php echo BASE_URL; ?>assets/css/style.css" as="style">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">

    <link rel="preload" href="<?php echo BASE_URL; ?>assets/css/admin.css" as="style">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/admin.css">
</head>
<body class="change-body">
    <div class="change-container">
        <h2>Cambiar contraseña</h2>
        <p class="change-desc">Por seguridad debes actualizar tus credenciales antes de continuar.</p>

        <?php if ($mensaje): ?>
            <p class="change-success"><?= $mensaje ?></p>
        <?php endif; ?>

        <form method="POST" class="change-form">
            <label>Nueva contraseña</label>
            <input type="password" name="password" required pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d]).{8,}">
            <small class="help">
                Mínimo 8 caracteres, una mayúscula, una minúscula, un número y un símbolo.
            </small>

            <button type="submit" class="change-btn">Guardar cambios</button>
        </form>
    </div>
</body>
</html>