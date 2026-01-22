<?php
session_start();
require "../config/config.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: " . BASE_URL . "admin/login.php");
    exit();
}

if (isset($_SESSION["force_change"]) && $_SESSION["force_change"] == true) {
    header("Location: " . BASE_URL . "admin/configuracion/cambiar-credenciales.php");
    exit();
}

// if (!isset($_SESSION["2fa_verified"])) {
//     header("Location: " . BASE_URL . "admin/configuracion/verificar-2fa.php");
//     exit();
// }

$id = $_SESSION["admin_id"];

$sql = "SELECT nombre FROM admin_users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

include('includes/header.php');
include('includes/sidebar.php');
?>
<body>
<main class="main-content">
    <h1>Panel administrativo</h1>

    <div class="grid-cards">
        <a href="investigadores/index.php" class="card">
            <h3>Investigadores</h3>
            <p>Administrar investigadores</p>
        </a>

        <a href="proyectos/index.php" class="card">
            <h3>Proyectos</h3>
            <p>Gestionar proyectos científicos</p>
        </a>

        <a href="tesis/index.php" class="card">
            <h3>Tesis</h3>
            <p>Registrar y actualizar tesis</p>
        </a>

        <a href="libros/index.php" class="card">
            <h3>Libros</h3>
            <p>Subir y editar libros</p>
        </a>

        <a href="investigaciones/index.php" class="card">
            <h3>Investigaciones</h3>
            <p>Control de investigaciones</p>
        </a>

        <a href="configuracion/index.php" class="card">
            <h3>Configuración</h3>
            <p>Usuarios y ajustes</p>
        </a>
    </div>
</main>

<?php include('includes/footer.php'); ?>