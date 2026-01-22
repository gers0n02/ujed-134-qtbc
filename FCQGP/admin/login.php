<?php
session_start();
if (isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

include('../config/config.php');
include('includes/header.php');
?>
<body>
    <div class="login-container">
        <h2>Iniciar sesión</h2>
        <?php
        if (isset($_GET['error-email'])) {
            echo "<p class='error'>Correo incorrecto.</p>";
        }

        if (isset($_GET['error-pass'])) {
            echo "<p class='error'>Contraseña incorrecta.</p>";
        }

        if (isset($_GET['must_change'])) {
            echo "<p class='error'>Debes cambiar tus credenciales antes de continuar.</p>";
        }

        if (isset($_GET['changed'])) {
            echo "<p class='success'>Credenciales actualizadas. Inicia sesión nuevamente.</p>";
        }

        if (isset($_GET['changed_pass'])) {
            $pass = $_SESSION["admin_email"];
            echo "<p class='success'>Tu nueva contraseña es: $pass</p>";
        }
        ?>

        <form action="configuracion/procesar_login.php" method="POST">
            <label>Correo electrónico</label>
            <input type="email" name="email" required>

            <label>Contraseña</label>
            <div class="password-field">
                <input type="password" name="password" id="password" required>
                <span class="toggle-password" onclick="togglePassword('password')">
                    ver
                </span>
            </div>

            <button type="submit">Ingresar</button>
        </form>

        <p><a href="configuracion/recuperar.php" class="link-recuperar">¿Olvidaste tu contraseña?</a></p>
    </div>

    <script src="<?php echo BASE_URL ?>assets/js/script.js"></script>
</body>
</html>