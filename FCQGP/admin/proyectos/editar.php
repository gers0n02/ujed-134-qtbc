<?php
session_start();
require '../../config/config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
}

$id = (int) $_GET['id'];

$sql = "SELECT * FROM proyectos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$proyecto = $stmt->get_result()->fetch_assoc();

$sql = "SELECT id, nombre FROM investigadores";
$investigadores = $conn->query($sql);

if (!$proyecto) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Facultad de Ciencias Químicas - UJED. Información, investigaciones y alumnado.">
    <title>Editar proyecto</title>

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

<div class="form-wrapper main-content">
    <div class="form-card">
        <h2>Editar proyecto</h2>

        <form action="actualizar.php" method="POST" enctype="multipart/form-data">
            <div class="form-grid">
                <div class="form-group">
                    <input type="hidden" name="id" value="<?= $proyecto['id'] ?>">
                </div>

                <div class="form-group">
                    <label>Investigador</label>
                    <select name="investigador_id" required>
                        <?php while($row = $investigadores->fetch_assoc()): ?>
                            <option value="<?= $row['id'] ?>" <?= ($proyecto['investigador_id']==$row['id']) ? "selected" : "" ?>><?= $row['nombre'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Nombre del proyecto</label>
                    <input type="text" name="nombre" value="<?= htmlspecialchars($proyecto['nombre']) ?>" required>
                </div>

                <div class="form-group">    
                    <label>Entidad financiera</label>
                    <input type="text" name="entidad_financiera" value="<?= htmlspecialchars($proyecto['entidad_financiera']) ?>" required>
                </div>

                <div class="form-group">    
                    <label>Clave</label>
                    <input type="text" name="clave" value="<?= htmlspecialchars($proyecto['clave']) ?>" required>
                </div>
            </div>

            <div class="form-actions">
                <a href="index.php" class="btn-cancel">Cancelar</a>
                <button type="submit" class="btn-save">Guardar cambios</button>
            </div>
        </form>
    </div>
</div>

<?php include('../includes/footer.php'); ?>