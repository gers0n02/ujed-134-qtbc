<?php
session_start();
require '../../config/config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Facultad de Ciencias Químicas - UJED. Información, investigaciones y alumnado.">
    <title>Nuevo investigador</title>

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
        <h2>Nuevo investigador</h2>

        <form action="guardar.php" method="POST" enctype="multipart/form-data">
            <div class="form-grid">
                <div class="form-group">
                    <label>Nombre completo</label>
                    <input type="text" name="nombre" required>
                </div>

                <div class="form-group">    
                    <label>LGAC</label>
                    <input type="text" name="lgac">
                </div>

                <div class="form-group">
                    <label>SEI</label>
                    <select name="sei" required>
                        <option value="">Selecciona una opción</option>
                        <option value="Candidato a Investigador">Candidato a Investigador</option>
                        <option value="Investigador estatal nivel I">Investigador estatal nivel I</option>
                        <option value="Investigador estatal honorífico">Investigador estatal honorífico</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>SNI</label>
                    <select name="sni" required>
                        <option value="">Selecciona una opción</option>
                        <option value="No">No</option>
                        <option value="Candidato">Candidato</option>
                        <option value="I">I</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>PRODEP</label>
                    <select name="pro_dep" required>
                        <option value="">Selecciona una opción</option>
                        <option value="Sí">Sí</option>
                        <option value="No">No</option>
                    </select>
                </div>

                <div class="form-group full">
                    <label>CV (PDF)</label>
                    <input type="file" name="cv" accept="application/pdf">
                </div>

                <div class="form-group full">
                    <label>Foto</label>
                    <input type="file" name="foto" accept="image/*">
                </div>
            </div>

            <div class="form-actions">
                <a href="index.php" class="btn-cancel">Cancelar</a>
                <button type="submit" class="btn-save">Guardar investigador</button>
            </div>
        </form>
    </div>
</div>

<?php include('../includes/footer.php'); ?>