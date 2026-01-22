<?php
session_start();
require "../../config/config.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];

    $sql = "SELECT * FROM admin_users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $new_pass = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789"), 0, 10);
        $hash = password_hash($new_pass, PASSWORD_DEFAULT);

        $sql = "UPDATE admin_users SET password = ?, debe_cambiar_pass = 1 WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $hash, $email);
        $stmt->execute();

        $_SESSION["admin_email"] = $new_pass;

        header("Location: " . BASE_URL . "admin/login.php?changed_pass=1");
    } else {
        $mensaje = "No se encontró el correo.";
    }
}

include("../includes/header.php");
?>

<body class="login-body">
    <div class="login-container">
        <h2>Recuperar contraseña</h2>

        <?php if ($mensaje): ?>
            <p class="error"><?= $mensaje ?></p>
        <?php endif; ?>

        <form method="post">
            <label>Ingresa tu correo</label>
            <input type="email" name="email" required>

            <button type="submit">Generar nueva contraseña</button>
        </form>
    </div>
</body>