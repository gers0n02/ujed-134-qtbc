<?php
session_start();
require '../../config/config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT proyectos.*, investigadores.nombre AS investigador FROM proyectos INNER JOIN investigadores ON proyectos.investigador_id = investigadores.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Facultad de Ciencias Químicas - UJED. Información, investigaciones y alumnado.">
    <title>Proyectos</title>

    <!-- ícono -->
    <link rel="icon" href="assets/img/icono.png" type="image/png">

    <!-- normalización --> 
    <link rel="preload" href="<?php echo BASE_URL; ?>assets/css/normalize.css" as="style">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/normalize.css">

    <link rel="preload" href="<?php echo BASE_URL; ?>assets/css/style.css" as="style">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">

    <link rel="preload" href="<?php echo BASE_URL; ?>assets/css/admin.css" as="style">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/admin.css">

    <link rel="preload" href="<?php echo BASE_URL; ?>assets/css/investigadores.css" as="style">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/investigadores.css">

    <!-- fuentes -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Open+Sans&family=PT+Sans:wght@400;700&display=swap" crossorigin="crossorigin" as="font">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">

</head>

<?php include('../includes/sidebar.php'); ?>

<div class="list-container main-content">
    <div class="list-header">
        <?php if (isset($_GET['eliminado'])): ?>
            <p class="alert-success">Proyecto eliminado correctamente.</p>
        <?php endif; ?>
        <h1>Proyectos</h1>
        <a href="crear.php" class="btn-primary">+ Nuevo proyecto</a>
    </div>
    <div class="table-responsive">
        <table>
            <tr>
                <th>Nombre</th>
                <th>Investigador</th>
                <th>Entidad financiera</th>
                <th>Clave</th>
                <th>Acciones</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['nombre']) ?></td>
                <td><?= htmlspecialchars($row['investigador']) ?></td>
                <td><?= htmlspecialchars($row['entidad_financiera']) ?></td>
                <td><?= htmlspecialchars($row['clave']) ?></td>
                <td>
                    <a href="editar.php?id=<?= $row['id'] ?>" class="btn btn-edit">Editar</a>
                    <a href="eliminar.php?id=<?= $row['id'] ?>" class="btn btn-delete" onclick="return confirm('¿Eliminar proyecto?')">Eliminar</a>
                </td>

            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>

<?php include('../includes/footer.php'); ?>