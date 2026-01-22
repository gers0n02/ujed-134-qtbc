<?php
session_start();
require '../../config/config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT investigaciones.*, investigadores.nombre AS investigador FROM investigaciones INNER JOIN investigadores ON investigaciones.investigador_id = investigadores.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Facultad de Ciencias Químicas - UJED. Información, investigaciones y alumnado.">
    <title>Investigaciones</title>

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
            <p class="alert-success">Investigación eliminada correctamente.</p>
        <?php endif; ?>
        <h1>Investigaciones</h1>
        <a href="crear.php" class="btn-primary">+ Nueva investigación</a>
    </div>
    <div class="table-responsive">
        <table>
            <tr>
                <th>Nombre</th>
                <th>Revista</th>
                <th>Año</th>
                <th>DOI</th>
                <th>Investigador</th>
                <th>Acciones</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['nombre_articulo']) ?></td>
                <td><?= htmlspecialchars($row['nombre_revista']) ?></td>
                <td><?= htmlspecialchars($row['anio']) ?></td>
                <td><?= htmlspecialchars($row['doi']) ?></td>
                <td><?= htmlspecialchars($row['investigador']) ?></td>
                <td>
                    <a href="editar.php?id=<?= $row['id'] ?>" class="btn btn-edit">Editar</a>
                    <a href="eliminar.php?id=<?= $row['id'] ?>" class="btn btn-delete" onclick="return confirm('¿Eliminar investigación?')">Eliminar</a>
                </td>

            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>

<?php include('../includes/footer.php'); ?>