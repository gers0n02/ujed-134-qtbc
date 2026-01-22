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

$sql = "SELECT * FROM investigaciones WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$investigacion = $stmt->get_result()->fetch_assoc();

$sql = "SELECT id, nombre FROM investigadores";
$investigadores = $conn->query($sql);

if (!$investigacion) {
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
    <title>Editar Investigación</title>

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
        <h2>Editar investigación</h2>

        <form action="actualizar.php" method="POST" enctype="multipart/form-data">
            <div class="form-grid">
                <div class="form-group">
                    <input type="hidden" name="id" value="<?= $investigacion['id'] ?>">
                </div>

                <div class="form-group">
                    <label>Investigador</label>
                    <select name="investigador_id" required>
                        <?php while($row = $investigadores->fetch_assoc()): ?>
                            <option value="<?= $row['id'] ?>" <?= ($investigacion['investigador_id']==$row['id']) ? "selected" : "" ?>><?= $row['nombre'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Autores</label>
                    <input type="text" name="autores" value="<?= htmlspecialchars($investigacion['autores']) ?>" required>
                </div>

                <div class="form-group">    
                    <label>Nombre del artículo</label>
                    <input type="text" name="nombre_articulo" value="<?= htmlspecialchars($investigacion['nombre_articulo']) ?>">
                </div>

                <div class="form-group">    
                    <label>Nombre de la revista</label>
                    <input type="text" name="nombre_revista" value="<?= htmlspecialchars($investigacion['nombre_revista']) ?>">
                </div>

                <div class="form-group">    
                    <label>Volumen</label>
                    <input type="text" name="volumen" value="<?= htmlspecialchars($investigacion['volumen']) ?>">
                </div>

                <div class="form-group">    
                    <label>Número de página</label>
                    <input type="text" name="numero_pagina" value="<?= htmlspecialchars($investigacion['numero_pagina']) ?>">
                </div>

                <div class="form-group">    
                    <label>Año</label>
                    <input type="number" name="anio" min="1900" max="2100" value="<?= htmlspecialchars($investigacion['anio']) ?>">
                </div>

                <div class="form-group">    
                    <label>DOI</label>
                    <input type="text" name="doi" value="<?= htmlspecialchars($investigacion['doi']) ?>">
                </div>

                <div class="form-group">    
                    <label>URL</label>
                    <input type="text" name="url" value="<?= htmlspecialchars($investigacion['url']) ?>">
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