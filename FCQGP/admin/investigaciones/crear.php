<?php
session_start();
require '../../config/config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT id, nombre FROM investigadores";
$investigadores = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Facultad de Ciencias Químicas - UJED. Información, investigaciones y alumnado.">
    <title>Nueva investigación</title>

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
        <h2>Nueva investigación</h2>

        <form action="guardar.php" method="POST" enctype="multipart/form-data">
            <div class="form-grid">

                <div class="form-group">
                    <label>Investigador</label>
                    <select name="investigador_id" required>
                        <option value="">Selecciona investigador</option>
                        <?php while($row = $investigadores->fetch_assoc()): ?>
                            <option value="<?= $row['id'] ?>"><?= $row['nombre'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Autores</label>
                    <input type="text" name="autores" required>
                </div>

                <div class="form-group">    
                    <label>Nombre del artículo</label>
                    <input type="text" name="nombre_articulo">
                </div>

                <div class="form-group">    
                    <label>Nombre de la revista</label>
                    <input type="text" name="nombre_revista">
                </div>

                <div class="form-group">    
                    <label>Volumen</label>
                    <input type="text" name="volumen">
                </div>

                <div class="form-group">    
                    <label>Número de página</label>
                    <input type="text" name="numero_pagina">
                </div>

                <div class="form-group">    
                    <label>Año</label>
                    <input type="number" name="anio" min="1900" max="2100">
                </div>

                <div class="form-group">    
                    <label>DOI</label>
                    <input type="text" name="doi">
                </div>

                <div class="form-group">    
                    <label>URL</label>
                    <input type="text" name="url">
                </div>
            </div>

            <div class="form-actions">
                <a href="index.php" class="btn-cancel">Cancelar</a>
                <button type="submit" class="btn-save">Guardar investigación</button>
            </div>
        </form>
    </div>
</div>

<?php include('../includes/footer.php'); ?>