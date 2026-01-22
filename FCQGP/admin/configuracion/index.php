<?php
session_start();
require '../../config/config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

$id = $_SESSION["admin_id"];

$sql = "SELECT email, nombre FROM admin_users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

include('../includes/header.php');
include('../includes/sidebar.php');
?>
<body>
<main class="main-content">
    <h2>Mi perfil</h2>

    <?php if (isset($_GET["success"])): ?>
        <p class="success">Datos actualizados correctamente.</p>
    <?php endif; ?>

    <form action="cambiar_perfil.php" method="POST" class="form-admin">
        <label>Nombre</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($user['nombre']); ?>" required>

        <label>Correo</label>
        <input type="email" name="email" value="">

        <hr>

        <label>Nueva contraseña</label>
        <input type="password" name="password" placeholder="Dejar vacío para no cambiar">

        <button type="submit" class="btn-guardar">Guardar cambios</button>
    </form>
</main>

<?php include('../includes/footer.php'); ?>