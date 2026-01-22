<?php
$id = $_SESSION["admin_id"];

$sql = "SELECT nombre FROM admin_users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>

<button id="menuMovil" class="menu-movil">&#9776;</button>

<aside class="sidebar">
    <div class="sidebar-header">
        <h2>FCQ Admin<br>Bienvenid@, <?php echo $user["nombre"]; ?></h2>
        <button id="menuMovil" class="menu-movil">→</button>
    </div>

    <nav>
        <a href="<?php echo BASE_URL; ?>admin/index.php">Inicio</a>
        <a href="<?php echo BASE_URL; ?>admin/investigadores/index.php">Investigadores</a>
        <a href="<?php echo BASE_URL; ?>admin/proyectos/index.php">Proyectos</a>
        <a href="<?php echo BASE_URL; ?>admin/tesis/index.php">Tesis</a>
        <a href="<?php echo BASE_URL; ?>admin/libros/index.php">Libros</a>
        <a href="<?php echo BASE_URL; ?>admin/investigaciones/index.php">Investigaciones</a>

        <hr>

        <a href="<?php echo BASE_URL; ?>admin/configuracion/index.php">Configuración</a>
        <a href="<?php echo BASE_URL; ?>admin/configuracion/logout.php" class="logout">Cerrar sesión</a>
    </nav>
</aside>