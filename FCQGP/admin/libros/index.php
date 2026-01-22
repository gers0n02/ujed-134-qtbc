<?php
session_start();
require '../../config/config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT libros.*, investigadores.nombre AS investigador FROM libros INNER JOIN investigadores ON libros.investigador_id = investigadores.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Facultad de Ciencias Químicas - UJED. Información, investigaciones y alumnado.">
    <title>Libros/capítulos</title>

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
            <p class="alert-success">Libro eliminado correctamente.</p>
        <?php endif; ?>
        <h1>Libros/Capítulos</h1>
        <a href="crear.php" class="btn-primary">+ Nuevo libro</a>
    </div>
    <div class="table-responsive">
        <table>
            <tr>
                <th>Título</th>
                <th>Investigador</th>
                <th>Año</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['titulo']) ?></td>
                <td><?= htmlspecialchars($row['investigador']) ?></td>
                <td><?= htmlspecialchars($row['anio']) ?></td>
                <td><?= htmlspecialchars($row['tipo']) ?></td>
                <td>
                    <a href="editar.php?id=<?= $row['id'] ?>" class="btn btn-edit">Editar</a>
                    <a href="eliminar.php?id=<?= $row['id'] ?>" class="btn btn-delete" onclick="return confirm('¿Eliminar libro/capítulo?')">Eliminar</a>
                </td>

            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>

<?php include('../includes/footer.php'); ?>